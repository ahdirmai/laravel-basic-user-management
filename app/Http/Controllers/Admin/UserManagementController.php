<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserManagementController extends Controller
{
    public function index()
    {

        $users = User::paginate(3);
        return view('pages.admin.user-management.index', ['users' => $users]);
    }

    public function create()
    {
        return view('pages.admin.user-management.form', [
            'method' => 'post',
            'action' => route('admin.users.store'),
            'roles' => Role::all(),
        ]);
    }

    public function store(Request $request)
    {
        return $this->saveUser($request);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('pages.admin.user-management.form', [
            'method' => 'put',
            'action' => route('admin.users.update', $user->id),
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        return $this->saveUser($request, $id);
    }

    private function saveUser(Request $request, $id = null)
    {
        // return $request->all();
        $this->validateRequest($request, $id);

        DB::beginTransaction();

        try {
            $user = $id ? User::findOrFail($id) : new User();
            $userData = $this->prepareUserData($request, $user);

            if (!$id) {
                $user->fill($userData);
                $user->save();
                $user->assignRole($request->role);
            } else {
                $user->update($userData);
                $user->syncRoles([$request->role]);
            }

            DB::commit();
            return redirect()->route('admin.users.index')->with('success', $id ? 'User berhasil diperbaharui' : 'User berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => ($id ? 'User update' : 'User creation') . ' failed: ' . $e->getMessage()]);
        }
    }

    private function validateRequest(Request $request, $userId = null)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'nik' => ['nullable', 'size:16', 'regex:/^\d+$/'],
            'email' => 'required|email|unique:users,email,' . $userId,
            'password' => $userId ? 'nullable|min:6' : 'required|min:6',
            'role' => 'required|exists:roles,name',
            'npwpd' => ['nullable', 'size:16', 'regex:/^\d+$/'],
            'nohp' => ['nullable', 'size:12', 'regex:/^\d+$/'],
            'fotopengguna' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $request->validate($rules);
    }

    private function prepareUserData(Request $request, User $user)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'npwpd' => $request->npwpd,
            'nohp' => $request->nohp,
        ];

        // Update password if provided
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        // Process photo upload
        if ($request->hasFile('fotopengguna')) {
            // Delete old photo if exists
            if ($user->fotopengguna) {
                Storage::delete('public/' . $user->fotopengguna);
            }

            // Store new photo
            $photoPath = $request->file('fotopengguna')->store('user-photos', 'public');
            $user->fotopengguna = $photoPath;
        }

        return $data;
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        DB::beginTransaction();

        try {
            // Delete user photo if it exists
            if ($user->fotopengguna) {
                Storage::delete('public/user-photos/' . $user->fotopengguna);
            }

            // Delete user from database
            $user->delete();

            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'Sukses menghapus pengguna');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to delete user: ' . $e->getMessage()]);
        }
    }
}

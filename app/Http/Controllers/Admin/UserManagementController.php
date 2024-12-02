<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserManagementController extends Controller
{
    // Menampilkan daftar pengguna
    public function index()
    {
        // Ambil semua data pengguna
        $users = User::paginate(3);
        return view('pages.admin.user-management.index', ['users' => $users]);
    }

    // Menampilkan form untuk membuat pengguna baru
    public function create()
    {
        return view('pages.admin.user-management.form', [
            'method' => 'post', // Metode HTTP POST
            'action' => route('admin.users.store'), // Rute untuk menyimpan data pengguna
            'roles' => Role::all(), // Ambil semua data role
        ]);
    }

    // Menyimpan data pengguna baru
    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $this->validateRequest($request);

        DB::beginTransaction(); // Memulai transaksi database

        try {
            // Persiapkan data pengguna
            $userData = $this->prepareUserData($request);

            // Buat pengguna baru dengan data yang telah diproses
            $user = User::create($userData);

            // Assign role ke pengguna
            $user->assignRole($request->role);

            DB::commit(); // Commit transaksi jika tidak ada error
            return redirect()->route('admin.users.index')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaksi jika terjadi error
            return redirect()->back()->withErrors(['error' => 'User creation failed: ' . $e->getMessage()]);
        }
    }

    // Menampilkan form untuk mengedit pengguna
    public function edit($id)
    {
        // Cari pengguna berdasarkan ID
        $user = User::findOrFail($id);

        return view('pages.admin.user-management.form', [
            'method' => 'put', // Metode HTTP PUT
            'action' => route('admin.users.update', $user->id), // Rute untuk memperbarui data pengguna
            'user' => $user, // Data pengguna yang akan diedit
            'roles' => Role::all(), // Ambil semua data role
        ]);
    }

    // Memperbarui data pengguna
    public function update(Request $request, $id)
    {
        // Cari pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Validasi data yang diterima dari request
        $this->validateRequest($request, $user->id);

        DB::beginTransaction(); // Memulai transaksi database

        try {
            // Persiapkan data pengguna
            $userData = $this->prepareUserData($request, $user->fotopengguna);

            // Perbarui data pengguna
            $user->update($userData);

            // Sinkronkan role pengguna
            $user->syncRoles([$request->role]);

            DB::commit(); // Commit transaksi jika tidak ada error
            return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaksi jika terjadi error
            return redirect()->back()->withErrors(['error' => 'User update failed: ' . $e->getMessage()]);
        }
    }

    // Validasi request untuk menyimpan atau memperbarui pengguna
    private function validateRequest(Request $request, $userId = null)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'nik' => ['size:18', 'regex:/^\d+$/'],
            'email' => 'required|email|unique:users,email,' . $userId, // Email unik kecuali untuk pengguna saat ini
            'password' => $userId ? 'nullable|min:6' : 'required|min:6', // Password opsional saat update
            'role' => 'required|exists:roles,name', // Role harus valid
            'fotopengguna' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi file foto
        ];

        $request->validate($rules); // Validasi data sesuai aturan
    }

    // Persiapkan data pengguna untuk disimpan atau diperbarui
    private function prepareUserData(Request $request, $existingPhoto = null)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : null, // Enkripsi password jika ada
            'nik' => $request->nik,
            'npwpd' => $request->npwpd,
            'nohp' => $request->nohp,
            'fotopengguna' => $existingPhoto, // Gunakan foto yang ada jika tidak ada yang baru
        ];

        // Jika ada file foto baru, proses dan simpan
        if ($request->hasFile('fotopengguna')) {
            $imageName = time() . '.' . $request->fotopengguna->extension();
            $request->fotopengguna->move(public_path('user-photos'), $imageName);
            $data['fotopengguna'] = $imageName;
        }

        // Filter data untuk menghilangkan nilai null
        return array_filter($data, fn($value) => !is_null($value));
    }

    // Menghapus pengguna
    public function destroy($id)
    {
        // Cari pengguna berdasarkan ID
        $user = User::findOrFail($id);

        DB::beginTransaction(); // Memulai transaksi database

        try {
            // Hapus foto pengguna jika ada
            if ($user->fotopengguna && file_exists(public_path('user-photos/' . $user->fotopengguna))) {
                unlink(public_path('user-photos/' . $user->fotopengguna));
            }

            // Hapus pengguna dari database
            $user->delete();

            DB::commit(); // Commit transaksi jika tidak ada error
            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaksi jika terjadi error
            return redirect()->back()->withErrors(['error' => 'Failed to delete user: ' . $e->getMessage()]);
        }
    }
}

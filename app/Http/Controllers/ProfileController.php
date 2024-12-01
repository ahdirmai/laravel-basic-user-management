<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Fill the existing fields
        $user->fill($request->validated());

        // Handle email verification
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Handle additional fields
        $user->nik = $request->input('nik');
        $user->npwpd = $request->input('npwpd');
        $user->nohp = $request->input('nohp');

        // Handle file upload for user photo
        if ($request->hasFile('fotopengguna')) {
            // Delete old photo if exists
            if ($user->fotopengguna) {
                Storage::delete('public/' . $user->fotopengguna);
            }

            // Store new photo
            $photoPath = $request->file('fotopengguna')->store('user-photos', 'public');
            $user->fotopengguna = $photoPath;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Delete user's photo if exists
        if ($user->fotopengguna) {
            Storage::delete('public/' . $user->fotopengguna);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

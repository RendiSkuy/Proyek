<?php

namespace App\Http\Controllers\UserApp;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        return view('user-app.profile', ['user' => Auth::user()]);
    }

    public function update(Request $request)
{
    $user = Auth::user();

    // Validasi input
    $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'address' => 'nullable|string|max:255',
        'phone_number' => 'nullable|numeric|digits_between:10,15',
        'password' => 'nullable|string|min:6|max:32',
        'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Update data user dengan metode update langsung
    $updateData = [
        'username' => $request->username,
        'email' => $request->email,
        'address' => $request->address,
        'phone_number' => $request->phone_number,
    ];

    // Update password jika diisi
    if ($request->filled('password')) {
        $updateData['password'] = Hash::make($request->password);
    }

    // Jika ada gambar baru diupload, update gambar
    if ($request->hasFile('picture')) {
        $picture = $request->file('picture');
        $picturePath = $picture->store('uploads/profile', 'public');

        // Hapus gambar lama jika ada
        if ($user->picture && Storage::disk('public')->exists($user->picture)) {
            Storage::disk('public')->delete($user->picture);
        }

        $updateData['picture'] = $picturePath;
    }

    // Simpan perubahan ke database
    $user->update($updateData);

    // **🔄 Refresh data user agar perubahan langsung terlihat**
    Auth::setUser(User::find($user->id));

    return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
}
}

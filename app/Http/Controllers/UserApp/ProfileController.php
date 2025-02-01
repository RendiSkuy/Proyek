<?php

namespace App\Http\Controllers\UserApp;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $nasabah = Nasabah::where('email', Auth::user()->email)->first();

        if (!$nasabah) {
            return redirect()->route('login')->with('error', 'Data nasabah tidak ditemukan.');
        }

        return view('user-app.profile', compact('nasabah'));
    }

    public function update(Request $request)
    {
        $nasabah = Nasabah::where('email', Auth::user()->email)->first();

        if (!$nasabah) {
            return redirect()->route('profile.show')->with('error', 'Nasabah tidak ditemukan.');
        }

        // Validasi data
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:nasabahs,email,' . $nasabah->id,
            'alamat' => 'nullable|string|max:255',
            'telepon' => 'nullable|numeric|digits_between:10,15',
            'password' => 'nullable|string|min:6|max:32',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update data nasabah
        $updateData = [
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ];

        // Update password jika diisi
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        // Jika ada gambar baru diupload, update foto profil
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoPath = $foto->store('uploads/profile', 'public');

            // Hapus foto lama jika ada
            if ($nasabah->foto && Storage::disk('public')->exists($nasabah->foto)) {
                Storage::disk('public')->delete($nasabah->foto);
            }

            $updateData['foto'] = $fotoPath;
        }

        $nasabah->update($updateData);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}

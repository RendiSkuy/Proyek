<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminCmsUsersController extends Controller
{
    public function index()
    {
        $users = User::with('cmsPrivilege')->get(); // Pastikan relasi ke privilege ada
        return view('admin.cms-users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.cms-users.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable|string|min:6|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_cms_privileges' => 'required|exists:cms_privileges,id'
        ]);

        // Handle password hashing
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        }

        // Handle file upload
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('uploads/profile', 'public');
            $validatedData['photo'] = $path;
        }

        User::create($validatedData);

        return redirect()->route('admin.cms-users.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        return view('admin.cms-users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_cms_privileges' => 'required|exists:cms_privileges,id'
        ]);

        // Jika password diisi, lakukan hashing
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        } else {
            unset($validatedData['password']);
        }

        // Jika ada foto baru, hapus foto lama & upload foto baru
        if ($request->hasFile('photo')) {
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            $path = $request->file('photo')->store('uploads/profile', 'public');
            $validatedData['photo'] = $path;
        }

        $user->update($validatedData);

        return redirect()->route('admin.cms-users.index')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        // Hapus foto jika ada
        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();

        return redirect()->route('admin.cms-users.index')->with('success', 'User berhasil dihapus!');
    }
}

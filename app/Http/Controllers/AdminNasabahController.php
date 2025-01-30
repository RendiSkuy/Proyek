<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AdminNasabahController extends Controller
{
    public function index()
    {
        $nasabahs = User::all();
        return view('admin.nasabah.index', compact('nasabahs'));
    }

    public function create()
    {
        return view('admin.nasabah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:5|max:32',
            'address' => 'required|string|max:255',
            'telepon' => 'required|numeric|digits_between:10,15',
            'picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:3072', // 3MB limit
        ]);

        $imagePath = $request->hasFile('picture') ? 
            $request->file('picture')->store('nasabah_profiles', 'public') : null;

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'phone_number' => $request->telepon,
            'picture' => $imagePath,
        ]);

        return redirect()->route('admin.nasabah.index')->with('success', 'Nasabah berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $nasabah = User::findOrFail($id);
        return view('admin.nasabah.edit', compact('nasabah'));
    }

    public function update(Request $request, $id)
    {
        $nasabah = User::findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $nasabah->id,
            'password' => 'nullable|string|min:5|max:32',
            'address' => 'required|string|max:255',
            'telepon' => 'required|numeric|digits_between:10,15',
            'picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:3072',
        ]);

        if ($request->hasFile('picture')) {
            if ($nasabah->picture) {
                Storage::disk('public')->delete($nasabah->picture);
            }
            $imagePath = $request->file('picture')->store('nasabah_profiles', 'public');
            $nasabah->picture = $imagePath;
        }

        $nasabah->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $nasabah->password,
            'address' => $request->address,
            'phone_number' => $request->telepon,
        ]);

        return redirect()->route('admin.nasabah.index')->with('success', 'Nasabah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $nasabah = User::findOrFail($id);
        
        if ($nasabah->picture) {
            Storage::disk('public')->delete($nasabah->picture);
        }

        $nasabah->delete();
        return redirect()->route('admin.nasabah.index')->with('success', 'Nasabah berhasil dihapus.');
    }
}

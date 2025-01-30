<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sampah;
use App\Models\KategoriSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSampahController extends Controller
{
    public function index()
    {
        $sampahs = Sampah::with('kategori')->get();
        return view('admin.sampah.index', compact('sampahs'));
    }

    public function create()
    {
        $categories = KategoriSampah::all();
        return view('admin.sampah.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_sampah_id' => 'required|exists:kategori_sampahs,id',
            'harga_per_kg' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('sampah-images', 'public');
            $validatedData['image'] = $path;
        }

        Sampah::create($validatedData);

        return redirect()->route('admin.sampah.index')->with('success', 'Sampah berhasil ditambahkan!');
    }

    public function edit(Sampah $sampah)
    {
        $categories = KategoriSampah::all();
        return view('admin.sampah.edit', compact('sampah', 'categories'));
    }

    public function update(Request $request, Sampah $sampah)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_sampah_id' => 'required|exists:kategori_sampahs,id',
            'harga_per_kg' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Jika ada gambar baru, hapus gambar lama & upload gambar baru
        if ($request->hasFile('image')) {
            if ($sampah->image && Storage::disk('public')->exists($sampah->image)) {
                Storage::disk('public')->delete($sampah->image);
            }

            $path = $request->file('image')->store('sampah-images', 'public');
            $validatedData['image'] = $path;
        }

        $sampah->update($validatedData);

        return redirect()->route('admin.sampah.index')->with('success', 'Sampah berhasil diperbarui!');
    }

    public function destroy(Sampah $sampah)
    {
        // Hapus gambar jika ada
        if ($sampah->image && Storage::disk('public')->exists($sampah->image)) {
            Storage::disk('public')->delete($sampah->image);
        }

        $sampah->delete();

        return redirect()->route('admin.sampah.index')->with('success', 'Sampah berhasil dihapus!');
    }
}

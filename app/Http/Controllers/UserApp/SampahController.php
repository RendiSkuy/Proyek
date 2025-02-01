<?php

namespace App\Http\Controllers\UserApp;

use App\Http\Controllers\Controller;
use App\Models\Sampah;
use App\Models\KategoriSampah;
use Illuminate\Http\Request;

class SampahController extends Controller
{
    /**
     * Menampilkan daftar semua sampah.
     */
    public function index()
    {
        $sampahs = Sampah::with('kategoriSampah')->get();
        return view('user-app.sampah', compact('sampahs'));
    }

    /**
     * Menampilkan sampah berdasarkan kategori tertentu.
     */
    public function showByCategory($kategori_id)
    {
        $kategori = KategoriSampah::findOrFail($kategori_id);
        $sampahs = Sampah::where('kategori_sampah_id', $kategori_id)->get();

        return view('user-app.sampah', compact('kategori', 'sampahs'));
    }
}

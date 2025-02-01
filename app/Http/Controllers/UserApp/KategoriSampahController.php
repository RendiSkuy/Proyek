<?php

namespace App\Http\Controllers\UserApp;

use App\Http\Controllers\Controller;
use App\Models\KategoriSampah;
use App\Models\Sampah;
use Illuminate\Http\Request;

class KategoriSampahController extends Controller
{
    /**
     * Menampilkan daftar kategori sampah dan sampah berdasarkan kategori.
     */
    public function index()
    {
        $kategoriSampahs = KategoriSampah::with('sampahs')->get();

        return view('user-app.kategori-sampah', compact('kategoriSampahs'));
    }
}

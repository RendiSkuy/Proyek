<?php

namespace App\Http\Controllers\UserApp;

use App\Models\Poin;
use App\Models\Nasabah;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard.
     */
    public function index()
    {
        // Mendapatkan data user yang sedang login
        $user = Auth::user();
        
        // Mencari data nasabah terkait user
        $nasabah = Nasabah::where('user_id', $user->id)->first();
        
        if (!$nasabah) {
            return redirect()->route('login')->with('error', 'Data nasabah tidak ditemukan.');
        }
        
        // Mengambil poin nasabah berdasarkan nasabah_id
        $point = Poin::where('nasabah_id', $nasabah->id)->first();
        
        // Jika point tidak ditemukan, buat object kosong dengan nilai default
        if (!$point) {
            $point = new \stdClass();
            $point->id = 0;
            $point->jumlah = 0;
        }
        
        // Mengambil transaksi terakhir (3 transaksi terakhir)
        $transactions = Transaksi::where('nasabah_id', $nasabah->id)
            ->latest()
            ->limit(3)
            ->get();
        
        // Menghitung total reward yang sudah digunakan
        $tukar_poin = $transactions->sum('point_received');
        
        return view('user-app.dashboard', compact(
            'user',
            'nasabah',
            'point',
            'transactions',
            'tukar_poin'
        ));
    }
}
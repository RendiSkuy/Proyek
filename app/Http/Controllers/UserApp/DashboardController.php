<?php

namespace App\Http\Controllers\UserApp;

use App\Models\Poin;
use App\Models\Nasabah;
use App\Models\Transaksi;
use App\Models\TukarPoin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard dengan data dari database.
     */
    public function index()
    {
        // Pastikan user yang login adalah nasabah
        $nasabah = Auth::guard('nasabah')->user();

        if (!$nasabah) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai nasabah.');
        }

        // Mengambil jumlah poin nasabah
        $point = Poin::where('nasabah_id', $nasabah->id)->first();
        $total_poin = $point ? $point->jumlah : 0;

        // Mengambil total transaksi dan total pendapatan (profit)
        $transactions = Transaksi::where('nasabah_id', $nasabah->id)
            ->latest()
            ->limit(3)
            ->get();

        $total_profit = Transaksi::where('nasabah_id', $nasabah->id)->sum('total_harga'); // Gunakan total_harga

        // Menghitung total reward yang sudah ditukar oleh user
        $tukar_poin = TukarPoin::where('nasabah_id', $nasabah->id)->count();

        // Ambil foto profil dengan default path
        if ($nasabah->foto && Storage::disk('public')->exists($nasabah->foto)) {
            $profile_picture = asset('storage/' . $nasabah->foto);
        } else {
            $profile_picture = asset('images/default-profile.png');
        }

        // Menampilkan data ke halaman dashboard
        return view('user-app.dashboard', compact(
            'nasabah',
            'total_poin',
            'total_profit',
            'transactions',
            'tukar_poin',
            'profile_picture'
        ));
    }
}

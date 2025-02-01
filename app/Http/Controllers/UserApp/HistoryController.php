<?php

namespace App\Http\Controllers\UserApp;

use App\Models\Transaksi;
use App\Models\Nasabah;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:nasabah'); // Pastikan hanya nasabah yang bisa mengakses
    }

    /**
     * Menampilkan halaman riwayat transaksi.
     */
    public function transactionHistory()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login kembali.');
        }

        // Dapatkan informasi nasabah
        $nasabah = Nasabah::where('email', Auth::user()->email)->first();

        if (!$nasabah) {
            return redirect()->route('login')->with('error', 'Data nasabah tidak ditemukan.');
        }

        // Ambil transaksi milik nasabah
        $transactions = Transaksi::where('nasabah_id', $nasabah->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('user-app.riwayat-transaksi', compact('transactions'));
    }

    /**
     * Menampilkan detail transaksi berdasarkan ID.
     */
    public function show($id)
    {
        $transaction = Transaksi::with('details.sampah')->findOrFail($id);

        // Pastikan transaksi milik nasabah yang login
        $nasabah = Nasabah::where('email', Auth::user()->email)->first();
        if (!$nasabah || $transaction->nasabah_id !== $nasabah->id) {
            return redirect()->route('transaction.history')->with('error', 'Akses tidak diizinkan.');
        }

        return view('user-app.detail-transaksi', compact('transaction'));
    }
}

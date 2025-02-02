<?php

namespace App\Http\Controllers\UserApp;

use App\Models\Transaksi;
use App\Models\Poin;
use App\Models\TukarPoin;
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
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login kembali.');
        }

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
        $nasabah = Auth::user();

        if ($transaction->nasabah_id !== $nasabah->id) {
            return redirect()->route('transaction.history')->with('error', 'Akses tidak diizinkan.');
        }

        return view('user-app.detail-transaksi', compact('transaction'));
    }

    /**
     * Menampilkan halaman Riwayat Poin.
     */
    public function poinHistory()
    {
        $nasabah = Auth::user();

        // Ambil riwayat poin berdasarkan nasabah_id
        $transactions = Poin::where('nasabah_id', $nasabah->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user-app.riwayat-poin', compact('transactions'));
    }

    /**
     * Menampilkan halaman Riwayat Tukar Poin.
     */
    public function tukarPoinHistory()
    {
        $nasabah = Auth::user();

        // Ambil riwayat tukar poin berdasarkan nasabah_id
        $tukarPoinHistory = TukarPoin::where('nasabah_id', $nasabah->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user-app.riwayat-pesanan', compact('tukarPoinHistory'));
    }
}

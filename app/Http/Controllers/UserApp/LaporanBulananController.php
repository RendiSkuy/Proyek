<?php

namespace App\Http\Controllers\UserApp;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LaporanBulananController extends Controller
{
    public function index()
    {
        $nasabah_id = Auth::id(); // Ambil ID nasabah yang sedang login
        $bulan = Carbon::now()->format('Y-m'); // Ambil bulan dan tahun saat ini

        // Ambil total setoran bulan ini hanya untuk nasabah yang login
        $totalSetoran = Transaksi::where('nasabah_id', $nasabah_id)
            ->where('tanggal', 'like', "$bulan%")
            ->selectRaw('SUM(total_berat) as total_berat, SUM(total_harga) as total_harga, SUM(total_poin) as total_poin')
            ->first();

        // Ambil semua transaksi bulan ini untuk nasabah yang login
        $transaksiBulanan = Transaksi::where('nasabah_id', $nasabah_id)
            ->where('tanggal', 'like', "$bulan%")
            ->orderBy('tanggal', 'desc')
            ->get();

        // Ambil daftar jenis sampah yang sudah disetor bulan ini
        $jenisSampah = TransaksiDetail::whereHas('transaksi', function ($query) use ($nasabah_id, $bulan) {
                $query->where('nasabah_id', $nasabah_id)
                    ->where('tanggal', 'like', "$bulan%");
            })
            ->join('sampahs', 'transaksi_details.sampah_id', '=', 'sampahs.id')
            ->select('sampahs.nama', 'transaksi_details.berat', 'transaksi_details.harga', 'transaksi_details.poin', 'transaksi_details.transaksi_id')
            ->get();

        return view('user-app.laporan-bulanan', compact('totalSetoran', 'transaksiBulanan', 'jenisSampah'));
    }
}

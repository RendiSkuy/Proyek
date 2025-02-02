<?php

namespace App\Http\Controllers\UserApp;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\Poin;
use App\Models\Reward;
use App\Models\TukarPoin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TukarPoinController extends Controller
{
    public function index()
    {
        $nasabah = Auth::user();
        
        // Ambil saldo poin dari tabel Poin berdasarkan nasabah_id
        $poin = Poin::where('nasabah_id', $nasabah->id)->first();
        $total_poin = $poin ? $poin->jumlah : 0;

        // Ambil reward berdasarkan kategori yang memiliki stok lebih dari 0
        $hiasan = Reward::where('kategori', 'hiasan')->where('stok', '>', 0)->get();
        $peralatan = Reward::where('kategori', 'peralatan')->where('stok', '>', 0)->get();
        $perlengkapan = Reward::where('kategori', 'perlengkapan')->where('stok', '>', 0)->get();
        $voucher = Reward::where('kategori', 'voucher')->where('stok', '>', 0)->get(); // Tambahkan Voucher

        return view('user-app.tukar-poin.index', compact('hiasan', 'peralatan', 'perlengkapan', 'voucher', 'nasabah', 'total_poin'));
    }

    public function show($id)
    {
        $reward = Reward::findOrFail($id);
        return view('user-app.tukar-poin.reward', compact('reward'));
    }

    public function store($id)
    {
        $reward = Reward::findOrFail($id);
        $nasabah = Auth::user();
        
        // Ambil saldo poin dari database
        $poin = Poin::where('nasabah_id', $nasabah->id)->first();
        if (!$poin) {
            return redirect()->route('tukar-poin.failed')->with('error', 'Anda tidak memiliki poin.');
        }

        if ($poin->jumlah >= $reward->poin_dibutuhkan && $reward->stok > 0) {
            TukarPoin::create([
                'nasabah_id' => $nasabah->id,
                'reward_id' => $reward->id,
                'jumlah' => 1,
                'status' => 'Pending',
                'tanggal_tukar' => now()
            ]);

            $reward->decrement('stok');
            $poin->decrement('jumlah', $reward->poin_dibutuhkan);

            return redirect()->route('tukar-poin.success')->with('success', 'Penukaran poin berhasil!');
        }

        return redirect()->route('tukar-poin.failed')->with('error', 'Poin tidak mencukupi atau stok habis!');
    }
public function confirm($id)
{
    $reward = Reward::findOrFail($id);
    $nasabah = Auth::user();

    // Ambil saldo poin pengguna
    $poin = Poin::where('nasabah_id', $nasabah->id)->first();
    $total_poin = $poin ? $poin->jumlah : 0;

    // Hitung sisa poin setelah penukaran
    $point_left = $total_poin - $reward->poin_dibutuhkan;

    return view('user-app.tukar-poin.konfirmasi-tukar-poin', compact('reward', 'poin', 'point_left', 'nasabah'));
}

    public function success()
    {
        return view('user-app.tukar-poin.success');
    }

    public function failed()
    {
        return view('user-app.tukar-poin.failed');
    }
}

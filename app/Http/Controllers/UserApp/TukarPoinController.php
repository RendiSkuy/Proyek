<?php

namespace App\Http\Controllers\UserApp;

use App\Http\Controllers\Controller;
use App\Models\Poin;
use App\Models\Reward;
use App\Models\TukarPoin;
use Illuminate\Http\Request;

class TukarPoinController extends Controller
{
    public function index()
    {
        // Ambil reward berdasarkan kategori
        $hiasan = Reward::where('kategori', 'hiasan')->get();
        $peralatan = Reward::where('kategori', 'peralatan')->get();
        $perlengkapan = Reward::where('kategori', 'perlengkapan')->get();

        // Ambil poin nasabah
        $point = Poin::where('nasabah_id', auth()->user()->nasabah->id)->first();

        return view('user-app.tukar-poin.tukar-poin-page', compact('hiasan', 'peralatan', 'perlengkapan', 'point'));
    }

    public function show($id)
    {
        $reward = Reward::findOrFail($id);
        $point = Poin::where('nasabah_id', auth()->user()->nasabah->id)->first();

        return view('user-app.tukar-poin.reward', compact('reward', 'point'));
    }

    public function confirm($id)
    {
        $reward = Reward::findOrFail($id);
        $point = Poin::where('nasabah_id', auth()->user()->nasabah->id)->first();
        $point_left = $point->jumlah - $reward->poin_dibutuhkan;

        return view('user-app.tukar-poin.konfirmasi-tukar-poin', compact('reward', 'point', 'point_left'));
    }

    public function store($id)
    {
        $reward = Reward::findOrFail($id);
        $point = Poin::where('nasabah_id', auth()->user()->nasabah->id)->first();

        if ($point->jumlah >= $reward->poin_dibutuhkan && $reward->stok > 0) {
            TukarPoin::create([
                'nasabah_id' => auth()->user()->nasabah->id,
                'reward_id' => $reward->id,
                'jumlah' => 1,
                'status' => 'Pending',
                'tanggal_tukar' => now()
            ]);

            $reward->decrement('stok');
            $point->decrement('jumlah', $reward->poin_dibutuhkan);

            return redirect()->route('tukar-poin.success')->with('success', 'Penukaran poin berhasil!');
        }

        return redirect()->route('tukar-poin.failed')->with('error', 'Poin tidak mencukupi atau stok habis!');
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

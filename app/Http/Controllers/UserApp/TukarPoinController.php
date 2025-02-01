<?php

namespace App\Http\Controllers\UserApp;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\Reward;
use App\Models\TukarPoin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TukarPoinController extends Controller
{
    public function index()
    {
        $nasabah = Auth::user();
        $hiasan = Reward::where('kategori', 'hiasan')->get();
        $peralatan = Reward::where('kategori', 'peralatan')->get();
        $perlengkapan = Reward::where('kategori', 'perlengkapan')->get();

        return view('user-app.tukar-poin.index', compact('hiasan', 'peralatan', 'perlengkapan', 'nasabah'));
    }

    public function store($id)
    {
        $reward = Reward::findOrFail($id);
        $nasabah = Auth::user();

        if ($nasabah->total_poin >= $reward->poin_dibutuhkan && $reward->stok > 0) {
            TukarPoin::create([
                'nasabah_id' => $nasabah->id,
                'reward_id' => $reward->id,
                'jumlah' => 1,
                'status' => 'Pending',
                'tanggal_tukar' => now()
            ]);

            $reward->decrement('stok');
            $nasabah->decrement('total_poin', $reward->poin_dibutuhkan);

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


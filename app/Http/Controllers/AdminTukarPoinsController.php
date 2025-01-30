<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TukarPoin;
use App\Models\Nasabah;
use App\Models\Reward;
use Illuminate\Http\Request;

class AdminTukarPoinsController extends Controller
{
    public function index()
    {
        $tukarPoins = TukarPoin::with(['nasabah', 'reward'])->latest()->get();
        return view('admin.tukar-poin.index', compact('tukarPoins'));
    }

    public function create()
    {
        $nasabahs = Nasabah::all();
        $rewards = Reward::where('stok', '>', 0)->get();
        return view('admin.tukar-poin.create', compact('nasabahs', 'rewards'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nasabah_id' => 'required|exists:nasabahs,id',
            'reward_id' => 'required|exists:rewards,id',
            'jumlah' => 'required|integer|min:1',
            'status' => 'required|in:Pending,On Proses,Diterima',
        ]);

        $reward = Reward::findOrFail($request->reward_id);

        if ($reward->stok < $request->jumlah) {
            return redirect()->back()->withErrors(['error' => 'Stok reward tidak mencukupi!']);
        }

        $validatedData['tanggal_tukar'] = now();

        TukarPoin::create($validatedData);

        // Update stok reward
        $reward->update([
            'stok' => $reward->stok - $request->jumlah
        ]);

        return redirect()->route('admin.tukar-poin.index')->with('success', 'Tukar Poin berhasil ditambahkan!');
    }

    public function edit(TukarPoin $tukarPoin)
    {
        $nasabahs = Nasabah::all();
        $rewards = Reward::where('stok', '>', 0)->get();
        return view('admin.tukar-poin.edit', compact('tukarPoin', 'nasabahs', 'rewards'));
    }

    public function update(Request $request, TukarPoin $tukarPoin)
    {
        $validatedData = $request->validate([
            'nasabah_id' => 'required|exists:nasabahs,id',
            'reward_id' => 'required|exists:rewards,id',
            'jumlah' => 'required|integer|min:1',
            'status' => 'required|in:Pending,On Proses,Diterima',
        ]);

        $reward = Reward::findOrFail($request->reward_id);

        // Cek stok reward sebelum update jumlah
        if ($reward->stok + $tukarPoin->jumlah < $request->jumlah) {
            return redirect()->back()->withErrors(['error' => 'Stok reward tidak mencukupi untuk perubahan ini!']);
        }

        // Update stok reward
        $reward->update([
            'stok' => ($reward->stok + $tukarPoin->jumlah) - $request->jumlah
        ]);

        $tukarPoin->update($validatedData);

        return redirect()->route('admin.tukar-poin.index')->with('success', 'Tukar Poin berhasil diperbarui!');
    }

    public function destroy(TukarPoin $tukarPoin)
    {
        $tukarPoin->delete();
        return redirect()->route('admin.tukar-poin.index')->with('success', 'Tukar Poin berhasil dihapus!');
    }
}

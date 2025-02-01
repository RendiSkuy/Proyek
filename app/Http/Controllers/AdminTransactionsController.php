<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Nasabah;
use App\Models\Sampah;
use Illuminate\Http\Request;

class AdminTransactionsController extends Controller
{
    public function index()
    {
        $transactions = Transaksi::with(['nasabah:id,nama'])->latest()->limit(50)->get();
        return view('admin.transaksi.index', compact('transactions'));
    }

    public function create()
    {
        $nasabahs = Nasabah::select(['id', 'nama'])->get();
        $sampahs = Sampah::select(['id', 'nama', 'harga_per_kg', 'poin_per_kg'])->get();
        return view('admin.transaksi.create', compact('nasabahs', 'sampahs'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nasabah_id' => 'required|exists:nasabahs,id',
            'sampah_id' => 'required|exists:sampahs,id',
            'total_berat' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:255',
            'status' => 'required|in:sedang di proses,selesai',
        ]);

        $sampah = Sampah::findOrFail($request->sampah_id);

        $validatedData['total_harga'] = $sampah->harga_per_kg * $request->total_berat;
        $validatedData['total_poin'] = $sampah->poin_per_kg * $request->total_berat;
        $validatedData['tanggal'] = now();
        $validatedData['kode_transaksi'] = 'TRX-' . now()->format('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(6));

        $transaksi = Transaksi::create($validatedData);
        $transaksi->updateTotals();

        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}

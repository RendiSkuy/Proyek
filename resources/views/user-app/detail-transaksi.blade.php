@extends('layout.main')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container">
    <h3 class="fw-bold mt-3">Detail Transaksi</h3>

    <div class="card shadow-sm p-3">
        @foreach ($transaction->details as $detail)
    <p><strong>Jenis Sampah:</strong> 
        {{ optional($detail->sampah)->name ?? 'Tidak Diketahui' }}
    </p>
    <p><strong>Total Berat:</strong> {{ $detail->berat }} Kg</p>
    <p><strong>Total Pendapatan:</strong> Rp. {{ number_format($detail->harga, 0, ',', '.') }}</p>
    <p><strong>Poin Diterima:</strong> {{ $detail->poin }}</p>
@endforeach

        <p><strong>Tanggal Transaksi:</strong> {{ $transaction->created_at->format('d M Y') }}</p>
    </div>
</div>
@endsection

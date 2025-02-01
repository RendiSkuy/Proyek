@extends('layout.main')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container">
    <div class="mb-3">
        <a href="{{ route('transaction.history') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <h5 class="card-title">Detail Transaksi</h5>
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-1"><strong>Kode Transaksi:</strong> {{ $transaction->kode_transaksi }}</p>
                    <p class="mb-1"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($transaction->tanggal)->format('d M Y') }}</p>
                    <p class="mb-1"><strong>Status:</strong> {{ $transaction->status }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1"><strong>Total Berat:</strong> {{ $transaction->total_berat }} Kg</p>
                    <p class="mb-1"><strong>Total Harga:</strong> Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</p>
                    <p class="mb-1"><strong>Total Poin:</strong> {{ $transaction->total_poin }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

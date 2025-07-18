@extends('layout.main')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="container">
    <h3 class="fw-bold mt-3">Riwayat Transaksi</h3>

    <!-- Tombol Kembali ke Dashboard -->
    <a href="{{ route('dashboard') }}" class="btn btn-success mb-3">
        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
    </a>

    @if ($transactions->isEmpty())
        <p class="text-center text-muted">Belum ada transaksi.</p>
    @else
        @foreach ($transactions as $transaction)
            <a href="{{ route('history.transaction.detail', $transaction->id) }}" class="text-decoration-none">
                <div class="card shadow-sm p-3 mb-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-bold mb-1">Setoran Sampah</p>
                            <p class="text-muted mb-0">Kode: <strong>{{ $transaction->kode_transaksi }}</strong></p>
                            <p class="text-muted mb-0">Total: <strong>{{ $transaction->total_berat }} Kg</strong></p>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($transaction->tanggal)->format('d M Y') }}</small>
                        </div>
                        <div class="text-end">
                            <p class="fw-bold text-success">+{{ number_format($transaction->total_harga, 0, ',', '.') }} IDR</p>
                            <small class="text-muted">Pendapatan</small>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    @endif
</div>
@endsection

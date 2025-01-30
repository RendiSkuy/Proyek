@extends('layout.main')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="container">
    <h3 class="fw-bold mt-3">Riwayat Transaksi</h3>

    @if ($transactions->isEmpty())
        <p class="text-center text-muted">Belum ada transaksi.</p>
    @else
        @foreach ($transactions as $transaction)
            <a href="{{ route('history.transactions', $transaction->id) }}" class="text-decoration-none">
                <div class="card shadow-sm p-3 mb-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-bold mb-1">Setoran Sampah</p>
                            <p class="text-muted mb-0">Total: <strong>{{ $transaction->total_berat }} Kg</strong></p>
                            <small class="text-muted">{{ $transaction->created_at->format('d M Y') }}</small>
                        </div>
                        <div class="text-end">
                            <p class="fw-bold text-success">+{{ number_format($transaction->total_harga, 0, ',', '.') }}</p>
                            <small class="text-muted">Pendapatan</small>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    @endif
</div>
@endsection

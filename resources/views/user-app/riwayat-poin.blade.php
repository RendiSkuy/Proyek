@extends('layout.main')

@section('title', 'Riwayat Poin')

@section('content')
<div class="container">
    <h3 class="fw-bold mt-3">Riwayat Poin</h3>

    @if ($transactions->isEmpty())
        <p class="text-center text-muted">Belum ada poin yang diterima.</p>
    @else
        @foreach ($transactions as $transaction)
            <div class="card shadow-sm p-3 mb-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-bold mb-1">Setoran Sampah</p>
                        <small class="text-muted">{{ date('d M Y', strtotime($transaction->tanggal)) }}</small>
                    </div>
                    <div class="text-end">
                        <p class="fw-bold text-primary">+{{ $transaction->total_poin }}</p>
                        <small class="text-muted">Poin Diterima</small>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
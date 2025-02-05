@extends('layout.main')

@section('title', 'Riwayat Poin | Bank Hijau Antapani')

@section('content')

<div class="container">
    <h3 class="fw-bold mt-3">Riwayat Poin</h3>

    <!-- Tombol Kembali -->
    <a href="{{ route('tukar-poin') }}" class="btn btn-success mb-3">
        <i class="fas fa-arrow-left"></i> Kembali ke Tukar Poin
    </a>

    @if ($transactions->isEmpty())
        <p class="text-center text-muted">Belum ada poin yang diterima.</p>
    @else
        @foreach ($transactions as $transaction)
            <div class="card shadow-sm p-3 mb-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-bold mb-1">Setoran Sampah</p>
                        <small class="text-muted">{{ date('d M Y', strtotime($transaction->created_at)) }}</small>
                    </div>
                    <div class="text-end">
                        <p class="fw-bold text-primary">+{{ number_format($transaction->jumlah, 0, ',', '.') }} Poin</p>
                        <small class="text-muted">Poin Diterima</small>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

@endsection

@extends('layout.main')

@section('title', 'Riwayat Pesanan | Bank Hijau Antapani')

@section('content')

<div class="container">
    <h3 class="fw-bold mt-3">Riwayat Tukar Poin</h3>

    @if ($tukarPoinHistory->isEmpty())
        <p class="text-center text-muted">Belum ada riwayat tukar poin.</p>
    @else
        @foreach ($tukarPoinHistory as $item)
            <div class="card shadow-sm p-3 mb-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-bold mb-1">{{ $item->reward->nama_reward }}</p>
                        <small class="text-muted">{{ $item->created_at->format('d M Y') }}</small>
                    </div>
                    <div class="text-end">
                        <p class="fw-bold text-danger">-{{ number_format($item->reward->poin_dibutuhkan, 0, ',', '.') }} Poin</p>
                        <small class="text-muted">Status: {{ $item->status }}</small>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

@endsection

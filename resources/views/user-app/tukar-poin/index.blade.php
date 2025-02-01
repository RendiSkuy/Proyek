@extends('layout.main')

@section('title', 'Tukar Poin | Bank Hijau Antapani')

@section('content')
<div class="reward-container">
    <div class="reward-header">
        <h3>Tukar Poin</h3>
        <p>Saldo Poin Anda: <strong>{{ $nasabah->total_poin ?? 0 }}</strong></p>
    </div>

    @foreach (['hiasan' => $hiasan, 'peralatan' => $peralatan, 'perlengkapan' => $perlengkapan] as $kategori => $items)
        <div class="reward-section">
            <h5 class="fw-bold text-primary mt-3">{{ ucfirst($kategori) }}</h5>
            <div class="reward-list">
                @forelse ($items as $reward)
                    <a href="{{ route('tukar-poin.show', $reward->id) }}" class="text-decoration-none">
                        <div class="reward-card">
                            <img src="{{ asset('storage/' . $reward->gambar) }}" alt="{{ $reward->nama_reward }}">
                            <h6>{{ $reward->poin_dibutuhkan }} Poin</h6>
                            <p>{{ $reward->nama_reward }}</p>
                        </div>
                    </a>
                @empty
                    <p class="text-muted">Belum ada hadiah dalam kategori ini.</p>
                @endforelse
            </div>
        </div>
    @endforeach
</div>
@endsection

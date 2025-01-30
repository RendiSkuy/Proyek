@extends('layout.main')

@section('title', 'Riwayat Tukar Poin')

@section('content')
<div class="container">
    <h3 class="fw-bold mt-3">Riwayat Tukar Poin</h3>

    @if ($tukarPoin_history->isEmpty())
        <p class="text-center text-muted">Belum ada riwayat tukar poin.</p>
    @else
        @foreach ($tukarPoin_history as $tukar)
            <div class="card shadow-sm p-3 mb-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-bold mb-1">{{ $tukar->reward->nama_reward }}</p>
                        <small class="text-muted">{{ $tukar->tanggal_tukar }}</small>
                    </div>
                    <div class="text-end">
                        <p class="fw-bold text-danger">-{{ $tukar->reward->poin_dibutuhkan }} Poin</p>
                        <small class="text-muted">{{ ucfirst($tukar->status) }}</small>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection

@extends('layout.main')

@section('title', 'Daftar Sampah | We-Cycle')

@section('content')
<header class="gradient-brand-toRight mx-auto rounded-bottom" style="max-width: 428px; width: 100%; background: linear-gradient(135deg, #2ECC71, #1E90FF);">
    <div class="container text-center px-4 py-4">
        <h4 class="mb-0 fw-bold text-light">DAFTAR SAMPAH</h4>
    </div>
</header>

<main class="container pt-4 pb-5">
    <div class="row">
        @forelse ($sampahs as $sampah)
            <div class="col-6 mb-3">
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                    <img src="{{ asset('storage/' . $sampah->gambar) }}" class="card-img-top" alt="{{ $sampah->nama }}">
                    <div class="card-body text-center">
                        <h6 class="fw-bold text-success">Rp.{{ number_format($sampah->harga_per_kg, 0, ',', '.') }} /Kg</h6>
                        <p class="text-muted">{{ $sampah->nama }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada data sampah.</p>
        @endforelse
    </div>
</main>
@endsection

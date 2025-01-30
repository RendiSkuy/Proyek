@extends('layout.main')
@section('title', 'Kategori Sampah | We-Cycle')

@section('content')
<header class="gradient-brand-toRight mx-auto rounded-bottom" style="max-width: 428px; width: 100%; background: linear-gradient(135deg, #2ECC71, #1E90FF);">
    <div class="container text-center px-4 py-4">
        <div class="row">
            <div class="col py-4 text-center text-light">
                <h4 class="mb-0 fw-bold" style="letter-spacing: 1px;">
                    KATEGORI PEMILAHAN <br>
                    SAMPAH
                </h4>
            </div>
        </div>
    </div>
</header>
<main style="min-height: calc(100vh - 150px);" class="main-container">
    <div class="container pt-4 pb-5 mb-5">
        <div class="row mx-auto mt-3">
            @foreach ($sampahByCategory as $categoryId => $sampah)
            <h5 class="fw-bold mb-3 text-primary">
                {{ $categoryId }}
            </h5>
            @forelse ($sampah as $item)
            <div class="col-6 mb-3">
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                    <img style="height: 110px; object-fit: cover;" src="{{ $item->image }}" class="card-img-top min-w-100" alt="...">
                    <div class="card-body text-center">
                        <h6 class="card-title my-0 fw-bold text-success">
                            Rp.{{ $item->price_per_kg }} /Kg
                        </h6>
                        <p class="card-text font-sm mt-0 text-muted">
                            {{ $item->name }}
                        </p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <div class="alert alert-warning" role="alert">
                    Belum ada data pada kategori ini.
                </div>
            </div>
            @endforelse
            @endforeach
        </div>
    </div>
    
    {{-- NAVIGATION MENU
    <div class="navigation-menu fixed-bottom bg-white shadow-sm py-2">
        <div class="container d-flex justify-content-around">
            <a class="nav-link text-center" href="/dashboard">
                <i class="bi bi-house text-primary" style="font-size: 1.5rem;"></i>
                <p class="text-dark fw-bold font-sm m-0">Beranda</p>
            </a>
            <a class="nav-link text-center active" href="/kategori-sampah">
                <i class="bi bi-trash text-success" style="font-size: 1.5rem;"></i>
                <p class="text-dark fw-bold font-sm m-0">Kategori</p>
            </a>
            <a class="nav-link text-center" href="/profile">
                <i class="bi bi-person text-primary" style="font-size: 1.5rem;"></i>
                <p class="text-dark fw-bold font-sm m-0">Profil</p>
            </a>
            <a class="nav-link text-center" href="/settings">
                <i class="bi bi-gear text-success" style="font-size: 1.5rem;"></i>
                <p class="text-dark fw-bold font-sm m-0">Pengaturan</p> --}}
            </a>
        </div>
    </div>
</main>
@endsection

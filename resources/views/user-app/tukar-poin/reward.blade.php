@extends('layout.header-tukar-poin')

@section('title', 'Tukar Poin | We-Cycle')

@section('tukar-point-content')
<!-- HERO REWARD -->
<div class="container-fluid mt-4 px-0 text-center">
    <img class="w-100 rounded-3 shadow-sm" style="max-height: 250px; object-fit: cover;" src="{{ url($reward->image) }}" alt="reward">
</div>

<div class="container mt-4 pb-5">
    <div class="row">
        <div class="col d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-dark m-0">
                {{ $reward->nama_reward }}
            </h5>
            <p class="fw-bold text-success">
                {{ number_format($reward->poin_dibutuhkan, 0, ',', '.') }} Poin
            </p>
        </div>
    </div>

    <div class="row">
        <p class="text-muted mt-2">
            {{ $reward->deskripsi }}
        </p>
    </div>

    <!-- BUTTON TUKAR POIN -->
    <div class="row text-center">
        <a class="btn btn-primary rounded-pill fw-bold my-3 px-4 py-2 shadow"
            href="{{ url('/tukar-poin/reward/'.$reward->id.'/konfirmasi') }}">
            Tukarkan Poin <i class="bi bi-arrow-right-circle ms-1"></i>
        </a>
    </div>
</div>

<!-- NAVIGATION MENU -->
<div class="navigation-menu">
    <div class="container d-flex justify-content-evenly">
        <a class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
            <i class="bi bi-house"></i>
            <p>Beranda</p>
        </a>
        <a class="nav-item {{ request()->is('kategori-sampah') ? 'active' : '' }}" href="/kategori-sampah">
            <i class="bi bi-recycle"></i>
            <p>Kategori</p>
        </a>
        <a class="nav-item {{ request()->is('profile') ? 'active' : '' }}" href="/profile">
            <i class="bi bi-person"></i>
            <p>Profil</p>
        </a>
        <a class="nav-item {{ request()->is('settings') ? 'active' : '' }}" href="/settings">
            <i class="bi bi-gear"></i>
            <p>Pengaturan</p>
        </a>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 2.5,
        spaceBetween: 20,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
</script>
@endsection

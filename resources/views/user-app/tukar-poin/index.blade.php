@extends('layout.main')

@section('title', 'Tukar Poin | Bank Hijau Antapani')

@section('content')

<head>
    <style>
        :root {
            --primary-green: #2ECC71;
            --primary-blue: #1E90FF;
            --background-light: #F8F9FA;
            --text-dark: #333;
        }

        .profile-header img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 2px solid white;
            position: absolute;
            top: 15px;
            right: 15px;
        }

        /* Kartu Poin */
        .point-card {
            background: white;
            border-radius: 12px;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            margin: -20px auto 15px;
            width: 90%;
        }

        .point-card h3 {
            font-size: 20px;
            color: var(--text-dark);
        }

        /* Tombol Aksi */
        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .action-btn {
            flex: 1;
            text-align: center;
            background: var(--primary-blue);
            color: white;
            padding: 10px;
            border-radius: 8px;
            font-weight: bold;
            text-decoration: none;
            margin: 0 5px;
            transition: 0.3s;
        }

        .action-btn:hover {
            background: var(--primary-green);
        }

        /* Kategori */
        .category-title {
            font-weight: bold;
            color: var(--primary-blue);
            margin-top: 15px;
        }

        /* Grid Reward */
        .reward-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 15px;
        }

        .reward-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 10px;
            transition: transform 0.3s ease;
        }

        .reward-card:hover {
            transform: scale(1.05);
        }

        .reward-card img {
            width: 100%;
            height: 90px;
            object-fit: cover;
            border-radius: 8px;
        }

        .reward-card h6 {
            font-weight: bold;
            margin: 8px 0 3px;
            color: var(--primary-blue);
        }

        /* Navigasi Bawah */
        .navigation-menu {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: white;
            padding: 10px 0;
            box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-around;
        }

        .nav-button {
            text-align: center;
            text-decoration: none;
            color: var(--primary-blue);
            flex: 1;
            padding: 5px 0;
            font-size: 0.9rem;
        }

        .nav-button i {
            font-size: 22px;
            display: block;
            margin-bottom: 3px;
        }

        .nav-button:hover,
        .nav-button.active {
            color: var(--primary-green);
        }

    </style>
</head>

<div class="point-card">
    <h3>Saldo Poin Anda:</h3>
    <h3 class="text-primary">{{ number_format($total_poin, 0, ',', '.') }} Poin</h3>
</div>

<!-- Tombol Aksi -->
<div class="action-buttons">
    <a href="{{ route('point.history') }}" class="action-btn">Riwayat Poin</a>
    <a href="{{ route('tukar-point.history') }}" class="action-btn">Pesanan Saya</a>
</div>

<!-- REWARD SECTION -->
<div class="container">
    <h4 class="fw-bold text-dark">REWARD UNTUKMU</h4>

    @foreach (['Hiasan' => $hiasan, 'Peralatan' => $peralatan, 'Perlengkapan' => $perlengkapan, 'Voucher' => $voucher] as $kategori => $items)
    <h5 class="category-title">{{ $kategori }}</h5>
    <div class="reward-list">
        @forelse ($items as $reward)
            <a href="{{ route('tukar-poin.show', $reward->id) }}" class="text-decoration-none">
                <div class="reward-card">
                    <img src="{{ asset('storage/' . $reward->gambar) }}" alt="{{ $reward->nama_reward }}">
                    <h6>{{ number_format($reward->poin_dibutuhkan, 0, ',', '.') }} Poin</h6>
                    <p class="text-muted small">{{ $reward->nama_reward }}</p>
                </div>
            </a>
        @empty
            <p class="text-muted">Belum ada hadiah dalam kategori ini.</p>
        @endforelse
    </div>
@endforeach

</div>

<!-- NAVIGATION MENU -->
<div class="navigation-menu">
    <a href="/dashboard" class="nav-button">
        <i class="bi bi-house"></i>
        <p>Beranda</p>
    </a>
    <a href="/kategori-sampah" class="nav-button">
        <i class="bi bi-recycle"></i>
        <p>Kategori</p>
    </a>
    <a href="/profile" class="nav-button">
        <i class="bi bi-person"></i>
        <p>Profil</p>
    </a>
    <a href="/settings" class="nav-button">
        <i class="bi bi-gear"></i>
        <p>Pengaturan</p>
    </a>
</div>

@endsection

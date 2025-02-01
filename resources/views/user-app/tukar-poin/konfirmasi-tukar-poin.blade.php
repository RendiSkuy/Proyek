@extends('layout.main')

@section('title', 'Konfirmasi Tukar Poin | Bank Hijau Antapani')

@section('content')
<head>
    <style>
        :root {
            --primary-green: #2ECC71;
            --secondary-green: #27AE60;
            --primary-blue: #1E90FF;
            --secondary-blue: #1565C0;
            --background-light: #F8F9FA;
            --danger-red: #DC3545;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--background-light);
            color: #333;
        }

        .confirm-container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .confirm-header {
            text-align: center;
            font-weight: bold;
            font-size: 1.5rem;
            color: var(--primary-blue);
            margin-bottom: 20px;
        }

        .reward-image {
            width: 100%;
            max-height: 280px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .btn-confirm {
            background: var(--primary-blue);
            color: white;
            padding: 12px 20px;
            font-size: 1rem;
            border-radius: 30px;
            font-weight: bold;
            text-decoration: none;
            display: block;
            text-align: center;
            transition: 0.3s;
            margin-top: 20px;
            border: none;
            cursor: pointer;
        }

        .btn-confirm:hover {
            background: var(--secondary-blue);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .btn-disabled {
            background: var(--danger-red);
            cursor: not-allowed;
            opacity: 0.7;
        }

        /* Navigation Menu */
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
            border-top: 2px solid var(--primary-green);
        }

        .nav-item {
            text-align: center;
            text-decoration: none;
            color: var(--primary-blue);
            flex: 1;
            padding: 5px 0;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .nav-item i {
            font-size: 22px;
            display: block;
            margin-bottom: 3px;
        }

        .nav-item:hover,
        .nav-item.active {
            color: var(--secondary-blue);
        }

    </style>
</head>

<div class="confirm-container">
    <h2 class="confirm-header">Konfirmasi Tukar Poin</h2>

    <img src="{{ url($reward->image) }}" alt="Reward" class="reward-image">

    <div class="detail-item">
        <span><strong>Nama Pengguna</strong></span>
        <span>{{ auth()->user()->username }}</span>
    </div>

    <div class="detail-item">
        <span><strong>Waktu Penukaran</strong></span>
        <span>{{ $time }}</span>
    </div>

    <div class="detail-item">
        <span><strong>Produk</strong></span>
        <span>{{ $reward->nama_reward }}</span>
    </div>

    <div class="detail-item">
        <span><strong>Stok Tersedia</strong></span>
        <span>{{ $reward->stock }}</span>
    </div>

    <div class="detail-item">
        <span><strong>Total Poin Dibutuhkan</strong></span>
        <span class="text-success">{{ number_format($reward->poin_dibutuhkan, 0, ',', '.') }} Poin</span>
    </div>

    <div class="detail-item">
        <span><strong>Poin Saya</strong></span>
        <span class="text-primary">{{ number_format($point->total_points, 0, ',', '.') }} Poin</span>
    </div>

    <div class="detail-item">
        <span><strong>Sisa Poin Setelah Penukaran</strong></span>
        <span class="{{ $point_left < 0 ? 'text-danger' : 'text-secondary' }}">
            {{ number_format($point_left, 0, ',', '.') }} Poin
        </span>
    </div>

    @if ($point->total_points < $reward->poin_dibutuhkan)
        <button class="btn-confirm btn-disabled">
            Poin Tidak Cukup <i class="bi bi-x-circle ms-1"></i>
        </button>
    @elseif ($reward->stock < 1)
        <button class="btn-confirm btn-disabled">
            Stok Tidak Tersedia <i class="bi bi-x-circle ms-1"></i>
        </button>
    @else
        <form action="{{ url('/tukar-poin/reward/'.$reward->id) }}" method="post">
            @csrf
            <button type="submit" class="btn-confirm">
                Konfirmasi Penukaran <i class="bi bi-check-circle ms-1"></i>
            </button>
        </form>
    @endif
</div>

<!-- NAVIGATION MENU -->
<div class="navigation-menu">
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
@endsection

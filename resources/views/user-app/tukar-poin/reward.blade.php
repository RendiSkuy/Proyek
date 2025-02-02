@extends('layout.main')

@section('title', 'Tukar Poin | Bank Hijau Antapani')

@section('content')
<head>
    <style>
        :root {
            --primary-green: #2ECC71;
            --secondary-green: #27AE60;
            --primary-blue: #1E90FF;
            --secondary-blue: #1565C0;
            --background-light: #F8F9FA;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--background-light);
            color: #333;
        }

        .reward-container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .reward-header {
            text-align: center;
            font-weight: bold;
            font-size: 1.5rem;
            color: var(--secondary-blue);
            margin-bottom: 20px;
        }

        .reward-image {
            width: 100%;
            max-height: 280px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .reward-details {
            margin-top: 20px;
            text-align: center;
        }

        .reward-name {
            font-size: 1.4rem;
            font-weight: bold;
            color: var(--primary-blue);
            margin-bottom: 5px;
        }

        .reward-points {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--primary-green);
        }

        .reward-description {
            color: #666;
            font-size: 1rem;
            margin-top: 15px;
        }

        .btn-exchange {
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
        }

        .btn-exchange:hover {
            background: var(--secondary-blue);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
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

<div class="reward-container">
    <h2 class="reward-header">Tukar Poin</h2>

    <img src="{{ asset('storage/' . $reward->gambar) }}" alt="Reward" class="reward-image">


    <div class="reward-details">
        <p class="reward-name">{{ $reward->nama_reward }}</p>
        <p class="reward-points">{{ number_format($reward->poin_dibutuhkan, 0, ',', '.') }} Poin</p>
        <p class="reward-description">{{ $reward->deskripsi }}</p>

        <a href="{{ route('tukar-poin.confirm', $reward->id) }}" class="btn-exchange">
            Tukarkan Poin <i class="bi bi-arrow-right-circle ms-1"></i>
        </a>        
    </div>
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

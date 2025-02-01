@extends('layout.main')

@section('title', 'Penukaran Poin Gagal | Bank Hijau Antapani')

@section('content')
<head>
    <style>
        :root {
            --primary-red: #DC3545;
            --secondary-red: #C82333;
            --primary-blue: #1E90FF;
            --background-light: #F8F9FA;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--background-light);
            color: #333;
        }

        .failed-container {
            max-width: 550px;
            margin: 50px auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .failed-header {
            font-weight: bold;
            font-size: 1.8rem;
            color: var(--primary-red);
        }

        .failed-image {
            width: 80%;
            max-width: 250px;
            margin: 20px auto;
            display: block;
        }

        .failed-text {
            font-size: 1rem;
            color: #555;
            margin-bottom: 20px;
        }

        .btn-home {
            background: var(--primary-blue);
            color: white;
            padding: 12px 20px;
            font-size: 1rem;
            border-radius: 30px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-home:hover {
            background: var(--secondary-red);
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
            border-top: 2px solid var(--primary-red);
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
            color: var(--secondary-red);
        }

    </style>
</head>

<div class="failed-container">
    <h2 class="failed-header">Transaksi Gagal</h2>

    <img src="{{ asset('images/failed.png') }}" alt="Failed Transaction" class="failed-image">

    <p class="failed-text">
        Mohon maaf, transaksi kamu tidak dapat diproses saat ini.<br>Silakan coba lagi nanti atau hubungi layanan pelanggan.
    </p>

    <a href="/dashboard" class="btn-home">
        Kembali ke Beranda <i class="bi bi-house-door-fill ms-1"></i>
    </a>
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

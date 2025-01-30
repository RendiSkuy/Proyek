@extends('layout.main')

@section('title', 'Dashboard | Bank Hijau Antapani')

@section('content')
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary-green: #2ECC71;
            --secondary-green: #27AE60;
            --primary-blue: #1E90FF;
            --secondary-blue: #1565C0;
            --background-gradient: linear-gradient(135deg, var(--primary-blue), var(--primary-green));
            --text-dark: #333;
            --text-light: white;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background: #F0F8FF;
            margin: 0;
            padding-bottom: 80px;
        }

        .dashboard-header {
            background: var(--background-gradient);
            padding: 20px;
            border-radius: 0 0 20px 20px;
            color: var(--text-light);
            text-align: left;
            position: relative;
        }

        .dashboard-header h4 {
            margin-bottom: 5px;
            font-weight: 400;
        }

        .dashboard-header .nasabah-name {
            font-weight: bold;
            color: var(--primary-blue);
        }

        .dashboard-header img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            position: absolute;
            top: 15px;
            right: 15px;
        }

        .summary-container {
            display: flex;
            justify-content: space-around;
            background: white;
            padding: 15px;
            border-radius: 15px;
            margin: 15px auto;
            width: 90%;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .summary-item {
            flex: 1;
            font-size: 14px;
        }

        .summary-item h4 {
            color: var(--primary-blue);
            margin-bottom: 5px;
        }

        .cta-button {
            background: var(--primary-blue);
            color: white;
            padding: 12px;
            border-radius: 12px;
            text-align: center;
            font-weight: bold;
            margin: 15px auto;
            width: 90%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .cta-button i {
            font-size: 22px;
        }

        .transaction-history {
            margin: 20px auto;
            width: 90%;
        }

        .transaction-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .transaction-header a {
            font-size: 14px;
            font-weight: bold;
            color: var(--primary-blue);
            text-decoration: none;
        }

        .transaction-header a:hover {
            text-decoration: underline;
        }

        .transaction-card {
            background: white;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .transaction-card .amount {
            font-weight: bold;
            color: var(--primary-blue);
        }

        .transaction-card .points {
            background: var(--primary-green);
            color: white;
            padding: 4px 8px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: bold;
        }

        .navigation-menu {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: white;
            padding: 8px 0;
            box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-around;
        }

        .nav-button {
            text-align: center;
            text-decoration: none;
            color: var(--primary-blue);
            flex: 1;
        }

        .nav-button i {
            font-size: 20px;
        }

        .nav-button.active {
            color: var(--secondary-blue);
            font-weight: bold;
        }
    </style>
</head>

<main>
    <div class="dashboard-header">
        <h4>Hai, <span class="nasabah-name">{{ $user->username }}</span></h4>
        <img src="{{ $user->picture ?? asset('images/default-profile.png') }}" alt="Profile">
    </div>

    <!-- Summary Poin & Profit -->
    <div class="summary-container">
        <div class="summary-item">
            <h4>{{ $point->jumlah ?? '0' }}</h4>
            <p>Points</p>
        </div>
        <div class="summary-item">
            <h4>Rp. {{ number_format($transactions->sum('total_income'), 0, ',', '.') }}</h4>
            <p>Profit</p>
        </div>
        <div class="summary-item">
            <h4>{{ $tukar_poin ?? '0' }}</h4>
            <p>Reward</p>
        </div>
    </div>

    <!-- Tukar Poin CTA -->
    <a href="/tukar-poin" class="cta-button">
        <i class="fas fa-gift"></i> Tukar Poinmu Sekarang!
    </a>

    <!-- Riwayat Transaksi -->
    <div class="transaction-history">
        <div class="transaction-header">
            <h5 class="fw-bold">Riwayat Transaksi</h5>
            <a href="/riwayat-transaksi">Lihat Semua</a>
        </div>

        @foreach ($transactions as $transaction)
        <div class="transaction-card">
            <p class="fw-bold">Setoran Sampah <span class="points">{{ $transaction->point_received }}</span></p>
            <p>Total: <span class="amount">{{ $transaction->total_weight }} Kg</span></p>
            <p class="text-muted">{{ date('d M Y', strtotime($transaction->created_at)) }}</p>
        </div>
        @endforeach
    </div>
</main>

<!-- NAVIGATION MENU -->
<div class="navigation-menu">
    <a href="/dashboard" class="nav-button active">
        <i class="fas fa-home"></i>
        <p>Beranda</p>
    </a>
    <a href="/kategori-sampah" class="nav-button">
        <i class="fas fa-recycle"></i>
        <p>Kategori</p>
    </a>
    <a href="/profile" class="nav-button">
        <i class="fas fa-user"></i>
        <p>Profil</p>
    </a>
    <a href="/settings" class="nav-button">
        <i class="fas fa-cog"></i>
        <p>Pengaturan</p>
    </a>
</div>
@endsection

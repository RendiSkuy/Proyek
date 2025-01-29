<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mobile-friendly -->
    <title>@yield('title')</title>

    <!-- Bootstrap & FontAwesome -->
    <link href="{{ asset('we-cycle-app/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background: linear-gradient(135deg, #1E90FF, #2ECC71);
            margin: 0;
            padding: 0;
            color: #333;
        }

        .dashboard-container {
            padding: 20px;
            max-width: 480px;
            margin: 0 auto;
            background: #F9F9F9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .dashboard-header {
            text-align: center;
            color: white;
            background: linear-gradient(135deg, #1E90FF, #2ECC71);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .dashboard-header img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-top: 10px;
        }

        .summary-cards {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
        }

        .summary-card {
            flex: 1;
            background: white;
            text-align: center;
            padding: 15px;
            margin: 0 5px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .summary-card h4 {
            margin: 0;
            color: #1E90FF;
        }

        .summary-card p {
            margin: 5px 0 0;
            color: #555;
        }

        .action-button {
            background: #2ECC71;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            display: block;
            margin: 0 auto;
            text-decoration: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .transaction-history {
            margin-top: 20px;
        }

        .transaction-item {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .navigation-menu {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: white;
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
        }

        .nav-button {
            text-align: center;
            text-decoration: none;
            color: #1E90FF;
            font-size: 14px;
            font-weight: bold;
        }

        .nav-button i {
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="dashboard-header">
        <h1>Hi, {{ $nasabah->name }}</h1>
        <p>ID Nasabah: {{ $nasabah->id }}</p>
        <img src="{{ $user->picture ?? asset('images/profile3.png') }}" alt="profile">
    </div>

    <div class="dashboard-container">
        <div class="summary-cards">
            <div class="summary-card">
                <h4>{{ $point->jumlah ?? '0' }}</h4>
                <p>Points</p>
            </div>
            <div class="summary-card">
                <h4>Rp. {{ number_format($transactions->sum('total_income'), 0, ',', '.') }}</h4>
                <p>Profit</p>
            </div>
            <div class="summary-card">
                <h4>{{ $tukar_poin }}</h4>
                <p>Reward</p>
            </div>
        </div>

        <a href="/rewards" class="action-button">Tukar Poinmu Sekarang!</a>

        <div class="transaction-history">
            <h5>Riwayat Transaksi</h5>
            @foreach ($transactions as $transaction)
            <div class="transaction-item">
                <div>
                    <p><strong>Setoran Sampah:</strong> {{ $transaction->point_received }} Poin</p>
                    <p>Total: {{ $transaction->total_weight }} Kg</p>
                </div>
                <div>
                    <p>Pendapatan:</p>
                    <p>Rp. {{ number_format($transaction->total_income, 0, ',', '.') }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="navigation-menu">
        <a href="/dashboard" class="nav-button">
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
</body>
</html>
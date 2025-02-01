@extends('layout.main')

@section('title', 'Dashboard | Bank Hijau Antapani')

@section('content')
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        :root {
            --primary-green: #32CD32;
            --secondary-green: #2E8B57;
            --primary-blue: #4169E1;
            --secondary-blue: #1E90FF;
            --background-gradient: linear-gradient(135deg, var(--primary-blue), var(--primary-green));
            --text-dark: #2C3E50;
            --text-light: white;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #F4F6F7;
            color: var(--text-dark);
        }

        /* HEADER */
        .dashboard-header {
            background: var(--background-gradient);
            padding: 25px;
            border-radius: 0 0 20px 20px;
            color: var(--text-light);
            text-align: left;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .dashboard-header h4 {
            font-weight: 500;
            font-size: 20px;
        }

        .dashboard-header img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
        }

        /* SUMMARY SECTION */
        .summary-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin: 20px auto;
            width: 90%;
            text-align: center;
        }

        .summary-item {
            background: white;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            font-weight: bold;
            transition: 0.3s ease-in-out;
        }

        .summary-item:hover {
            transform: scale(1.05);
        }

        .summary-item h4 {
            color: var(--primary-blue);
            font-size: 18px;
        }

        /* CTA BUTTON */
        .cta-button {
            background: var(--primary-green);
            color: white;
            padding: 14px;
            font-size: 16px;
            border-radius: 12px;
            text-align: center;
            width: 90%;
            margin: 20px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-weight: bold;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: 0.3s ease-in-out;
        }

        .cta-button:hover {
            background: var(--secondary-green);
            transform: translateY(-3px);
        }

        /* TRANSACTION HISTORY */
        .transaction-history {
            margin: 20px auto;
            width: 90%;
        }

        .transaction-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            font-size: 16px;
            font-weight: bold;
        }

        .transaction-header a {
            color: var(--primary-blue);
            text-decoration: none;
        }

        .transaction-card {
            background: white;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: 0.3s ease-in-out;
        }

        .transaction-card:hover {
            transform: scale(1.02);
        }

        .transaction-card p {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .transaction-card .amount {
            font-weight: bold;
            color: var(--primary-blue);
        }

        .transaction-card .points {
            background: var(--primary-green);
            color: white;
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 12px;
        }

        /* RESPONSIVE DESIGN */
        @media (max-width: 768px) {
            .summary-container {
                grid-template-columns: 1fr;
            }

            .transaction-history {
                width: 100%;
            }
        }
    </style>
</head>

<main>
    <!-- Header -->
    <div class="dashboard-header">
        <h4>Hai, <span class="nasabah-name">{{ $nasabah->nama }}</span></h4>
        <img src="{{ $profile_picture }}" alt="Profile">
    </div>

    <!-- Summary Poin & Profit -->
    <div class="summary-container">
        <div class="summary-item">
            <h4>{{ $total_poin }}</h4>
            <p>Points</p>
        </div>
        <div class="summary-item">
            <h4>Rp. {{ number_format($total_profit, 0, ',', '.') }}</h4>
            <p>Profit</p>
        </div>
        <div class="summary-item">
            <h4>{{ $tukar_poin }}</h4>
            <p>Reward</p>
        </div>
    </div>

    <!-- Tukar Poin CTA -->
    <a href="{{ route('tukar-poin') }}" class="cta-button">
        <i class="fas fa-gift"></i> Tukar Poinmu Sekarang!
    </a>

    <!-- Riwayat Transaksi -->
    <div class="transaction-history">
        <div class="transaction-header">
            <h5>Riwayat Transaksi</h5>
            <a href="/riwayat-transaksi">Lihat Semua</a>
        </div>

        @foreach ($transactions as $transaction)
        <div class="transaction-card">
            <p><strong>Setoran Sampah</strong> <span class="points">{{ $transaction->total_poin }} Poin</span></p>
            <p>Total: <span class="amount">{{ $transaction->total_berat }} Kg</span></p>
            <p class="text-muted">{{ date('d M Y', strtotime($transaction->tanggal)) }}</p>
        </div>
        @endforeach
    </div>
</main>
@endsection

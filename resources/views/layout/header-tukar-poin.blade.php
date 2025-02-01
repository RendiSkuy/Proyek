@extends('layout.main')

@section('content')
<head>
    <style>
        :root {
            --primary-green: #2ECC71;
            --secondary-green: #27AE60;
            --primary-blue: #1E90FF;
            --secondary-blue: #1565C0;
            --gradient-header: linear-gradient(135deg, var(--primary-green), var(--primary-blue));
            --text-light: white;
            --text-dark: #333;
            --background-light: #F8F9FA;
        }

        /* Header */
        .gradient-header {
            background: var(--gradient-header);
            color: var(--text-light);
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .points-container {
            background: var(--gradient-header);
            color: var(--text-light);
            padding: 15px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .points-container img {
            width: 60px;
        }

        .point-info {
            text-align: center;
        }

        .point-info p {
            margin: 0;
            font-size: 14px;
        }

        .point-amount {
            font-size: 22px;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .gradient-header {
                padding: 15px;
            }

            .points-container {
                flex-direction: column;
                text-align: center;
            }

            .points-container img {
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<header class="gradient-header">
    <div class="container text-center px-4">
        <h5 class="fw-bold m-0">Tukar Poin</h5>
    </div>
</header>

<div id="tukar-poin-page" class="main-container">
    <div class="container pt-4">
        <div class="points-container">
            <div class="point-info">
                <img src="{{ asset('images/logo-hero.png') }}" alt="We-Cycle Logo">
                <p>Poin Anda</p>
            </div>
            <div class="point-info">
                <p>Poin Saat Ini</p>
                <p class="point-amount">{{ number_format($point->total_points, 0, ',', '.') }}</p>
                <p style="font-size: 12px;">Berlaku Hingga</p>
                <p style="font-size: 12px;">31-12-2023</p>
            </div>
        </div>
    </div>

    @yield('tukar-point-content')
</div>

@endsection

@yield('scripts')

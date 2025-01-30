@extends('layout.main')

@section('content')
<head>
    <style>
        :root {
            --primary-green: #2ECC71;
            --secondary-green: #27AE60;
            --primary-blue: #1E90FF;
            --secondary-blue: #1565C0;
            --gradient-brand: linear-gradient(135deg, var(--primary-green), var(--primary-blue));
            --text-light: white;
            --text-dark: #333;
        }

        .gradient-header {
            background: var(--gradient-brand);
            color: var(--text-light);
            padding: 20px;
            border-radius: 12px;
            text-align: center;
        }

        .profile img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 2px solid white;
        }

        .points-container {
            background: var(--gradient-brand);
            color: var(--text-light);
            padding: 15px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 15px;
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
    </style>
</head>

<header class="gradient-header mx-auto" style="max-width: 428px; width: 100%;">
    <div class="container text-center px-4">
        <div class="row">
            <div class="col py-3 d-flex align-items-center justify-content-between">
                <div>
                    <p class="mb-0" style="font-size: 18px; font-weight: bold;">
                        Hai, {{ auth()->user()->username ?? 'Anonim' }}
                    </p>
                </div>
                <div class="profile">
                    <img src="{{ auth()->user()->picture ?? asset('images/profile3.png') }}" alt="profile">
                </div>
            </div>
        </div>
    </div>
</header>

<div id="tukar-poin-page" class="main-container">
    <div class="container pt-4">
        <div class="points-container">
            <div class="point-info">
                <img src="{{ asset('images/logo-hero.png') }}" alt="we-cycle-logo">
                <p>Points</p>
            </div>
            <div class="point-info">
                <p>Poin Saat Ini</p>
                <p class="point-amount">{{ $point->total_points }}</p>
                <p style="font-size: 12px;">Berlaku Hingga</p>
                <p style="font-size: 12px;">31-12-2023</p>
            </div>
        </div>
    </div>

    @yield('tukar-point-content')
</div>

@endsection

@yield('scripts')

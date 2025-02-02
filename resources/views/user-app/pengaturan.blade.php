@extends('layout.main')

@section('title', 'Pengaturan')

@section('content')
<head>
    <style>
        /* Warna Utama */
        :root {
            --primary-green: #2ECC71;
            --secondary-green: #27AE60;
            --primary-blue: #1E90FF;
            --secondary-blue: #1565C0;
            --background-light: #f5f5f5;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--background-light);
            color: #333;
            margin: 0;
        }

        .settings-container {
            max-width: 500px;
            margin: 40px auto;
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.15);
        }

        .settings-header {
            text-align: center;
            background: linear-gradient(135deg, var(--primary-green), var(--primary-blue));
            padding: 30px;
            border-radius: 15px 15px 0 0;
            color: white;
        }

        .settings-option {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.3s ease-in-out;
            cursor: pointer;
        }

        .settings-option:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        .settings-option:last-child {
            border-bottom: none;
        }

        .settings-option i {
            color: var(--primary-blue);
            font-size: 18px;
        }

        .settings-option a {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            font-size: 16px;
            flex-grow: 1;
            padding-left: 10px;
        }

        .logout-option {
            color: red;
            font-weight: bold;
        }

        .logout-option i {
            color: red;
        }

        @media (max-width: 768px) {
            .settings-container {
                width: 90%;
                padding: 20px;
                margin: 20px auto;
            }
        }
    </style>
</head>

<div class="settings-container">
    <div class="settings-header">
        <h2>Pengaturan</h2>
    </div>

    <div class="settings-option">
        <i class="fas fa-user"></i>
        <a href="/profile">Profil</a>
        <i class="fas fa-chevron-right"></i>
    </div>
    <div class="settings-option logout-option">
        <i class="fas fa-sign-out-alt"></i>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>
@endsection

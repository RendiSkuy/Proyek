@extends('layout.main')

@section('title', 'Transaksi Berhasil | Bank Hijau Antapani')

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

        .success-container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .success-header {
            background: linear-gradient(135deg, var(--primary-green), var(--primary-blue));
            padding: 20px;
            border-radius: 12px 12px 0 0;
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .success-icon {
            max-width: 200px;
            margin: 20px auto;
            display: block;
        }

        .success-message {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--secondary-blue);
            margin-bottom: 10px;
        }

        .success-text {
            font-size: 1rem;
            color: #666;
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
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-home:hover {
            background: var(--secondary-blue);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

    </style>
</head>

<div class="success-container">
    <div class="success-header">Transaksi Berhasil!</div>
    
    <img src="{{ asset('images/success.png') }}" alt="Success" class="success-icon">

    <p class="success-message">Terima Kasih!</p>
    <p class="success-text">Transaksi kamu telah berhasil dan akan segera diproses.</p>

    <a href="/dashboard" class="btn-home">Kembali ke Beranda</a>
</div>
@endsection

@extends('layout.main')

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

        .transaction-header {
            max-width: 768px;
            width: 100%;
            background: white;
            padding: 15px;
            border-bottom: 2px solid var(--primary-green);
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .transaction-header a {
            text-decoration: none;
            font-size: 1.5rem;
            color: var(--primary-blue);
            transition: color 0.3s ease-in-out;
        }

        .transaction-header a:hover {
            color: var(--secondary-blue);
        }

        .transaction-title {
            font-weight: bold;
            font-size: 1.4rem;
            color: var(--primary-green);
            text-transform: uppercase;
            flex: 1;
            text-align: center;
        }

        .spacer {
            width: 40px;
        }

        @media (max-width: 768px) {
            .transaction-header {
                padding: 12px;
            }
            
            .transaction-title {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<header class="transaction-header">
    {{-- Tombol Kembali --}}
    <a href="{{ url('dashboard') }}">
        <i class="bi bi-arrow-left"></i>
    </a>

    {{-- Judul Halaman --}}
    <h6 class="transaction-title">
        @yield('transaction-title')
    </h6>

    {{-- Spacer untuk keseimbangan desain --}}
    <div class="spacer"></div>
</header>

@yield('transaction-content')
@endsection

@yield('scripts')

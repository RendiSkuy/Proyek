<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('images/original.png') }}" type="image/x-icon">
    
    <!-- Bootstrap & FontAwesome -->
    <link href="{{ asset('we-cycle-app/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-green: #32CD32;
            --secondary-green: #228B22;
            --primary-blue: #4169E1;
            --secondary-blue: #1E90FF;
            --background-gradient: linear-gradient(135deg, var(--primary-green), var(--primary-blue));
            --text-dark: #2C3E50;
            --text-light: white;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--background-gradient);
            color: var(--text-dark);
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Main Container */
        .main-container {
            width: 100%;
            max-width: 1100px;
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
            margin-top: 25px;
        }

        /* Navbar */
        .navbar-custom {
            background: var(--background-gradient);
            padding: 15px;
            border-radius: 0 0 15px 15px;
        }

        .navbar-brand {
            font-weight: bold;
            color: white;
            font-size: 20px;
        }

        .navbar-nav .nav-link {
            color: white !important;
            font-weight: 500;
        }

        .dropdown-menu {
            background: white;
        }

        .dropdown-item:hover {
            background: var(--primary-green);
            color: white;
        }

        /* RESPONSIVE DESIGN */
        @media (max-width: 768px) {
            .main-container {
                max-width: 100%;
                border-radius: 0;
                padding: 15px;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar hanya muncul di halaman selain Panduan Sampah -->
    @if (!request()->is('panduan-sampah'))
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">Bank Hijau Antapani</a>
            
            <!-- Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
                            <i class="fas fa-home"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="kategoriDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-recycle"></i> Kategori Sampah
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/kategori-sampah">Semua Kategori</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('laporan-bulanan') }}">Laporan Bulanan</a>
                    </li>                                 
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('profile') ? 'active' : '' }}" href="/profile">
                            <i class="fas fa-user"></i> Profil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('settings') ? 'active' : '' }}" href="/settings">
                            <i class="fas fa-cog"></i> Pengaturan
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @endif

    <!-- MAIN CONTENT -->
    <div class="main-container">
        @yield('content')
    </div>

    <!-- Bootstrap Scripts -->
    <script src="{{ asset('we-cycle-app/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>

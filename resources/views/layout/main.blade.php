<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsif untuk mobile -->
    <title>@yield('title')</title>

    <!-- Bootstrap & FontAwesome -->
    <link href="{{ asset('we-cycle-app/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background: linear-gradient(135deg, #1E90FF, #2ECC71);
            color: white;
            margin: 0;
            padding: 0;
        }

        /* Navbar */
        .navbar {
            background: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar a {
            color: #1E90FF;
            font-weight: bold;
            text-decoration: none;
            margin: 0 15px;
        }

        .navbar a:hover {
            color: #1565C0;
            text-decoration: underline;
        }

        /* Kontainer utama */
        .main-container {
            margin: 100px auto 80px; /* Agar tidak tertutup navbar */
            padding: 20px;
            border-radius: 12px;
            color: #333;
        }

        /* Navigation Menu di Bawah */
        .navigation-menu {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: white;
            padding: 10px 0;
            box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-around;
            border-top: 2px solid #A5D6A7;
        }

        .nav-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #27AE60;
            padding: 5px 0;
            flex: 1;
            transition: all 0.3s ease;
        }

        .nav-button:hover,
        .nav-button.active {
            color: #2ECC71;
        }

        .nav-button i {
            font-size: 20px; /* Ukuran ikon lebih kecil */
        }

        .nav-button p {
            margin: 3px 0 0;
            font-size: 12px; /* Ukuran teks lebih kecil */
            font-weight: 500;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="/" class="navbar-brand">We-Cycle</a>
    </nav>

    <!-- Kontainer Konten -->
    <div class="main-container">
        @yield('content')
    </div>

    <!-- Navigation Menu -->
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
</body>
</html>

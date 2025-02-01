<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

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
            padding-bottom: 80px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Main Container */
        .main-container {
            width: 100%;
            max-width: 1100px; /* Menyesuaikan agar enak dilihat di desktop */
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
            margin-top: 25px;
        }

        /* HEADER */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--background-gradient);
            color: var(--text-light);
            padding: 20px;
            border-radius: 15px 15px 0 0;
        }

        .header img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
        }

        .header h4 {
            margin: 0;
            font-weight: bold;
            font-size: 22px;
        }

        /* NAVIGATION MENU */
        .navigation-menu {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: white;
            padding: 10px 0;
            box-shadow: 0 -3px 8px rgba(0, 0, 0, 0.15);
            display: flex;
            justify-content: space-around;
            border-top: 3px solid var(--primary-green);
        }

        .nav-button {
            text-align: center;
            text-decoration: none;
            color: var(--primary-blue);
            flex: 1;
            padding: 10px 0;
            transition: 0.3s ease-in-out;
            font-size: 14px;
            font-weight: bold;
        }

        .nav-button i {
            font-size: 22px;
            display: block;
            margin-bottom: 5px;
        }

        .nav-button:hover,
        .nav-button.active {
            color: var(--secondary-blue);
        }

        /* RESPONSIVE DESIGN */
        @media (max-width: 768px) {
            .main-container {
                max-width: 100%;
                border-radius: 0;
                padding: 15px;
            }

            .navigation-menu {
                padding: 8px 0;
            }

            .nav-button {
                font-size: 12px;
            }

            .nav-button i {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <div class="main-container">
        <div class="header">
            <h4>@yield('title')</h4>
            <img src="{{ asset('images/default-profile.png') }}" alt="Profile">
        </div>

        @yield('content')
    </div>

    <!-- FOOTER NAVIGATION -->
    <div class="navigation-menu">
        <a href="/dashboard" class="nav-button {{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            <p>Beranda</p>
        </a>
        <a href="/kategori-sampah" class="nav-button {{ request()->is('kategori-sampah') ? 'active' : '' }}">
            <i class="fas fa-recycle"></i>
            <p>Kategori</p>
        </a>
        <a href="/profile" class="nav-button {{ request()->is('profile') ? 'active' : '' }}">
            <i class="fas fa-user"></i>
            <p>Profil</p>
        </a>
        <a href="/settings" class="nav-button {{ request()->is('settings') ? 'active' : '' }}">
            <i class="fas fa-cog"></i>
            <p>Pengaturan</p>
        </a>
    </div>
</body>
</html>

<!-- resources/views/layout/main.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Bootstrap & FontAwesome -->
    <link href="{{ asset('we-cycle-app/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-green: #2ECC71;
            --secondary-green: #27AE60;
            --primary-blue: #1E90FF;
            --secondary-blue: #1565C0;
            --background-gradient: linear-gradient(135deg, var(--primary-green), var(--primary-blue));
            --text-dark: #333;
            --text-light: white;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background: var(--background-gradient);
            color: var(--text-dark);
            margin: 0;
            padding-bottom: 70px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .main-container {
            width: 100%;
            max-width: 480px;
            background: white;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        /* Header */
        .dashboard-header, .settings-header {
            text-align: center;
            padding: 20px;
            border-radius: 12px;
            background: var(--background-gradient);
            color: var(--text-light);
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .settings-container {
            background: white;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .settings-option {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .settings-option:last-child {
            border-bottom: none;
        }

        .settings-option i {
            color: var(--primary-blue);
            margin-right: 10px;
        }

        .settings-option a {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
        }

        /* Footer Navigation */
        .navigation-menu {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: white;
            padding: 10px 0;
            box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-around;
            border-top: 2px solid var(--primary-green);
        }

        .nav-button {
            text-align: center;
            text-decoration: none;
            color: var(--primary-blue);
            flex: 1;
            padding: 5px 0;
            transition: all 0.3s ease;
        }

        .nav-button i {
            font-size: 22px;
            display: block;
            margin-bottom: 3px;
        }

        .nav-button:hover,
        .nav-button.active {
            color: var(--secondary-blue);
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div class="settings-header">
            <h2>Pengaturan</h2>
        </div>

        <div class="settings-container">
            <div class="settings-option">
                <a href="/profile"><i class="fas fa-user"></i> Profil</a>
                <i class="fas fa-chevron-right"></i>
            </div>
            {{-- <div class="settings-option">
                <a href="/security"><i class="fas fa-lock"></i> Keamanan</a>
                <i class="fas fa-chevron-right"></i>
            </div> --}}
            <div class="settings-option">
                <a href="/notifications"><i class="fas fa-bell"></i> Notifikasi</a>
                <i class="fas fa-chevron-right"></i>
            </div>
            <div class="settings-option">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i> Logout
            </div>
        </div>
    </div>

    <!-- Footer Navigation -->
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
        <a href="/settings" class="nav-button active">
            <i class="fas fa-cog"></i>
            <p>Pengaturan</p>
        </a>
    </div>
</body>
</html>
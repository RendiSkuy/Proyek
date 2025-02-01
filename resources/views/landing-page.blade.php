<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Hijau Antapani</title>

    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        /* Warna & Tema */
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

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, var(--primary-green), var(--primary-blue));
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .navbar .nav-link {
            color: white;
            font-weight: bold;
            transition: color 0.3s ease-in-out;
        }

        .navbar .nav-link:hover {
            color: #f0f0f0;
        }

        /* Hero Section */
        .hero-section {
            height: 85vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-green));
            color: white;
            padding: 20px;
        }

        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .hero-section p {
            font-size: 1.25rem;
            margin-bottom: 20px;
        }

        .hero-section .btn {
            background-color: #007BFF;
            color: white;
            border-radius: 30px;
            padding: 12px 30px;
            font-weight: bold;
            transition: background 0.3s ease-in-out;
        }

        .hero-section .btn:hover {
            background-color: #0056b3;
        }

        /* Fitur Section */
        .features {
            background-color: #E8F5E9;
            padding: 80px 0;
            text-align: center;
        }

        .features h2 {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--primary-green);
            margin-bottom: 40px;
        }

        .features .card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background: #fff;
        }

        .features .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .features .card i {
            color: #1E90FF;
            margin-bottom: 15px;
        }

        .features .card h3 {
            color: #27AE60;
            font-size: 1.5rem;
        }

        /* Footer */
        footer {
            background-color: #1E90FF;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        footer p {
            margin: 0;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Bank Hijau Antapani</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Masuk</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1>Selamat Datang di Bank Hijau Antapani</h1>
            <p>Menukarkan sampah menjadi poin yang bisa ditukarkan dengan hadiah menarik.</p>
            <a href="/login" class="btn btn-lg">Mulai Sekarang</a>
        </div>
    </div>

    <!-- Fitur Kami -->
    <section class="features">
        <div class="container">
            <h2>Fitur Kami</h2>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card h-100 text-center p-4">
                        <i class="fas fa-recycle fa-3x"></i>
                        <h3 class="mt-3">Tukar Sampah</h3>
                        <p>Tukarkan sampah Anda dengan poin yang dapat ditukar dengan hadiah.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card h-100 text-center p-4">
                        <i class="fas fa-gift fa-3x"></i>
                        <h3 class="mt-3">Dapatkan Reward</h3>
                        <p>Tukarkan poin Anda dengan berbagai hadiah menarik.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card h-100 text-center p-4">
                        <i class="fas fa-leaf fa-3x"></i>
                        <h3 class="mt-3">Jaga Lingkungan</h3>
                        <p>Kontribusi Anda membantu menjaga lingkungan lebih bersih dan berkelanjutan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 Bank Hijau Antapani. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>

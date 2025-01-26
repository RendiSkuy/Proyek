<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Hijau Antapani</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
        }
        .hero-section {
            height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: linear-gradient(135deg, #4CAF50, #2ECC71);
            color: white;
        }
        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .hero-section p {
            font-size: 1.25rem;
            margin-bottom: 20px;
        }
        .hero-section .btn {
            background-color: #2ECC71;
            color: white;
            border-radius: 30px;
            padding: 10px 25px;
        }
        .hero-section .btn:hover {
            background-color: #27AE60;
        }
        .features {
            background-color: #F9F9F9;
            padding: 60px 0;
        }
        .features h2 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2ECC71;
            margin-bottom: 40px;
        }
        .features .card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .features .card:hover {
            transform: translateY(-10px);
        }
        .features .card i {
            color: #2ECC71;
            margin-bottom: 15px;
        }
        footer {
            background-color: #2ECC71;
            color: white;
            padding: 20px 0;
        }
        footer p {
            margin: 0;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <header class="dashboard-header">
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #27AE60;">
            <div class="container">
                <a class="navbar-brand" href="#">Bank Hijau Antapani</a>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">Daftar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="hero-section">
        <div class="container">
            <h1 class="display-4">Selamat Datang di We-Cycle</h1>
            <p>Aplikasi kami memungkinkan Anda menukar sampah dengan poin yang dapat ditukarkan dengan hadiah menarik.</p>
            <a href="/register" class="btn btn-lg">Mulai Sekarang</a>
        </div>
    </div>

    <main>
        <section class="features">
            <div class="container">
                <h2 class="text-center">Fitur Kami</h2>
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
    </main>

    <footer class="text-center">
        <div class="container">
            <p>&copy; 2024 We-Cycle. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
</body>
</html>

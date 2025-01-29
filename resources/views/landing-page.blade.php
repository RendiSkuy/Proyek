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
            background-color: #f5f5f5;
        }
        .hero-section {
            height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: linear-gradient(135deg, #1E90FF, #2ECC71); /* Warna biru-hijau */
            color: white;
        }
        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: bold;
        }
        .hero-section p {
            font-size: 1.25rem;
            margin-bottom: 20px;
        }
        .hero-section .btn {
            background-color: #007BFF; /* Biru terang */
            color: white;
            border-radius: 30px;
            padding: 10px 25px;
            font-weight: bold;
        }
        .hero-section .btn:hover {
            background-color: #0056b3; /* Biru gelap */
        }
        .features {
            background-color: #E8F5E9; /* Hijau pucat */
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
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background: #fff;
        }
        .features .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .features .card i {
            color: #1E90FF; /* Ikon biru */
            margin-bottom: 15px;
        }
        .features .card h3 {
            color: #27AE60; /* Hijau */
        }
        .features .card p {
            color: #555;
        }
        footer {
            background-color: #1E90FF; /* Biru */
            color: white;
            padding: 20px 0;
        }
        footer p {
            margin: 0;
            font-size: 0.9rem;
        }
        .navbar {
            background: linear-gradient(135deg, #2ECC71, #1E90FF); /* Hijau-biru */
        }
        .navbar-brand {
            font-weight: bold;
        }
        .navbar .nav-link {
            color: white;
            font-weight: bold;
        }
        .navbar .nav-link:hover {
            color: #f0f0f0;
        }
    </style>
</head>
<body>
    <header class="dashboard-header">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="#">Bank Hijau Antapani</a>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Masuk</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="hero-section">
        <div class="container">
            <h1 class="display-4">Selamat Datang di Bank Hijau Antapani</h1>
            <p>Website kami memungkinkan Anda menukar sampah dengan poin yang dapat ditukarkan dengan hadiah menarik.</p>
            <a href="/login" class="btn btn-lg">Mulai Sekarang</a>
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
            <p>&copy; 2025 Bank Hijau Antapani. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
</body>
</html>

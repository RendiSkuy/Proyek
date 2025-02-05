<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Hijau Antapani</title>

    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="{{ asset('images/original.png') }}" type="image/x-icon">

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
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-green));
            color: white;
            padding: 50px 20px;
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

        /* Achievement Section */
        .achievement-section {
            background: #1E90FF;
            color: white;
            text-align: center;
            padding: 50px 20px;
        }

        .achievement-section h2 {
            font-weight: bold;
        }

        .achievement-item {
            margin: 20px 0;
        }

        /* Informasi Setoran Sampah */
        .info-section {
            background: white;
            padding: 50px 20px;
        }

        .info-section h3 {
            color: var(--primary-blue);
            font-weight: bold;
            margin-bottom: 30px;
        }

        .info-section p {
            font-size: 1rem;
        }

        /* Footer */
        footer {
            background-color: #1E90FF;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        .social-icons {
            margin-top: 10px;
        }

        .social-icons a {
            color: white;
            margin: 0 10px;
            font-size: 20px;
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: #FFD700;
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
            <a href="{{ route('panduan.sampah') }}" class="btn btn-lg">Mulai Sekarang</a>
        </div>
    </div>

    <!-- Achievement Section -->
    <div class="achievement-section">
        <div class="container">
            <h2>ACHIEVEMENT</h2>
            <div class="row">
                <div class="col-md-4 achievement-item">
                    <i class="fas fa-users fa-3x"></i>
                    <h3>1000</h3>
                    <p>User Baru</p>
                </div>
                <div class="col-md-4 achievement-item">
                    <i class="fas fa-recycle fa-3x"></i>
                    <h3>10 Ton</h3>
                    <p>Sampah Dikelola</p>
                </div>
                <div class="col-md-4 achievement-item">
                    <i class="fas fa-truck fa-3x"></i>
                    <h3>Setiap Minggu</h3>
                    <p>Pengambilan Sampah</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Setoran Sampah -->
    <section class="info-section">
        <div class="container">
            <h3>Prosedur Penjemputan Sampah oleh Bank Hijau Antapani</h3>
            <p><strong>1. Sampah Dijemput Setiap Hari Minggu</strong></p>
            <p>Pihak Bank Sampah akan menjemput sampah langsung dari rumah Anda.</p>

            <p><strong>2. Proses Penimbangan Sampah</strong></p>
            <p>Setelah diambil, sampah akan ditimbang untuk menentukan jumlah poin yang diperoleh.</p>

            <p><strong>3. Nasabah Menerima Poin</strong></p>
            <p>Setiap kilogram sampah yang disetor akan dikonversi menjadi poin.</p>

            <p><strong>4. Tukarkan Poin dengan Reward</strong></p>
            <p>Poin yang terkumpul bisa ditukarkan dengan hadiah menarik melalui sistem aplikasi kami.</p>

            <p class="text-center">
                <a href="#" class="text-primary fw-bold">Siap Menjadi Bagian dari Bank Hijau Antapani?</a>
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 Bank Hijau Antapani. All rights reserved.</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>

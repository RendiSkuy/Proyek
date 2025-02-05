@extends('layout.main')

@section('title', 'Panduan Pengelolaan Sampah')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold text-center">Panduan Pengelolaan Sampah Bank Hijau Antapani</h2>

    <!-- Cara Kerja -->
    <div class="card shadow-sm p-4 mt-3">
        <h4>1. Cara Kerja Bank Sampah Hijau Antapani</h4>
        <p>
            Bank Hijau Antapani menyediakan layanan pengelolaan sampah bagi masyarakat. Anda tidak perlu menyetor sampah, 
            karena <strong>setiap hari Minggu</strong>, tim kami akan melakukan **penjemputan sampah** langsung dari lokasi Anda.
        </p>
        <ul>
            <li><strong>Jadwal Penjemputan:</strong> Setiap hari Minggu, mulai pukul <strong>08:00 - 15:00 WIB</strong>.</li>
            <li><strong>Lokasi:</strong> Sampah akan dijemput dari rumah atau lokasi usaha yang telah terdaftar.</li>
            <li><strong>Notifikasi:</strong> Pengguna akan menerima pemberitahuan sebelum penjemputan dilakukan.</li>
        </ul>
    </div>

    <!-- Jenis Sampah yang Bisa Dijemput -->
    <div class="card shadow-sm p-4 mt-3">
        <h4>2. Jenis Sampah yang Dapat Dijemput</h4>
        <p>Sampah yang dapat dijemput oleh tim Bank Hijau Antapani adalah:</p>
        <ul>
            <li><strong>Plastik:</strong> Botol plastik, kantong plastik, kemasan plastik.</li>
            <li><strong>Logam:</strong> Kaleng bekas, aluminium, besi tua.</li>
            <li><strong>Kaca:</strong> Botol kaca, pecahan kaca.</li>
            <li><strong>Kertas:</strong> Kardus, koran, majalah, kertas bekas.</li>
        </ul>
        <p><strong>Catatan:</strong> Sampah organik dan sampah berbahaya tidak dapat dijemput.Jika terdapat Sampah Organik yang berbahaya akan di kembailikan kembali sampahnya</p>
    </div>

    <!-- Poin & Reward -->
    <div class="card shadow-sm p-4 mt-3">
        <h4>3. Poin & Penukaran Reward</h4>
        <p>
            Setelah sampah dijemput dan ditimbang, Anda akan mendapatkan poin yang bisa ditukarkan dengan reward menarik.
        </p>
        <p><strong>Konversi Poin:</strong></p>
        <ul>
            <li>1 Kg Plastik = 100 Poin</li>
            <li>1 Kg Kaleng = 200 Poin</li>
            <li>1 Kg Kaca = 150 Poin</li>
            <li>1 Kg Kertas = 80 Poin</li>
        </ul>
    </div>

    <!-- Tombol Lanjut ke Login -->
    <div class="text-center mt-4">
        <a href="{{ route('login') }}" class="btn btn-primary">Lanjut ke Login</a>
    </div>
</div>
@endsection

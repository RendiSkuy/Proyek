@extends('layout.main')

@section('title', 'Profil Saya')

@section('content')
<head>
    <style>
        /* Warna Utama */
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

        .profile-container {
            max-width: 500px;
            margin: 40px auto;
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.15);
        }

        .profile-header {
            text-align: center;
            background: linear-gradient(135deg, var(--primary-green), var(--primary-blue));
            padding: 30px;
            border-radius: 15px 15px 0 0;
            color: white;
        }

        .profile-header img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            margin-bottom: 12px;
        }

        .profile-info {
            margin-bottom: 15px;
        }

        .profile-info label {
            font-weight: 600;
            font-size: 14px;
            color: var(--secondary-blue);
            display: block;
            margin-bottom: 5px;
        }

        .profile-info input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }

        .btn-save {
            background: var(--primary-green);
            color: white;
            padding: 14px;
            width: 100%;
            border-radius: 10px;
            font-size: 16px;
            border: none;
            font-weight: 600;
            transition: 0.3s;
            cursor: pointer;
        }

        .btn-save:hover {
            background: var(--secondary-green);
        }

        .alert {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 8px;
            text-align: center;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 768px) {
            .profile-container {
                width: 90%;
                padding: 20px;
                margin: 20px auto;
            }
        }
    </style>
</head>

<div class="profile-container">
    <div class="profile-header">
        <img src="{{ $nasabah->foto ? asset('storage/' . $nasabah->foto) : asset('images/default-profile.png') }}" alt="Profile Picture">
        <h3>Profil Saya</h3>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="profile-info">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" value="{{ old('nama', $nasabah->nama) }}" required>
        </div>

        <div class="profile-info">
            <label for="email">Email:</label>
            <input type="email" name="email" value="{{ old('email', $nasabah->email) }}" required>
        </div>

        <div class="profile-info">
            <label for="alamat">Alamat:</label>
            <input type="text" name="alamat" value="{{ old('alamat', $nasabah->alamat) }}">
        </div>

        <div class="profile-info">
            <label for="telepon">Telepon:</label>
            <input type="text" name="telepon" value="{{ old('telepon', $nasabah->telepon) }}">
        </div>

        <div class="profile-info">
            <label for="password">Password Baru:</label>
            <input type="password" name="password" placeholder="Masukkan password baru">
        </div>

        <div class="profile-info">
            <label for="foto">Foto Profil:</label>
            <input type="file" name="foto">
        </div>

        <button type="submit" class="btn-save">Simpan Perubahan</button>
    </form>
</div>
@endsection

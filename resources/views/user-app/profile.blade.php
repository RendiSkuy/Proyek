@extends('layout.main')

@section('title', 'Profil Saya')

@section('content')
<head>
    <meta name="viewport" content="width=device-width">
    <style>
        :root {
            --primary-green: #2ECC71;
            --secondary-green: #27AE60;
            --primary-blue: #1E90FF;
            --secondary-blue: #1565C0;
            --background-light: #F1F8E9;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background: var(--background-light);
            color: #333;
            padding-bottom: 80px;
        }

        .profile-container {
            max-width: 450px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            text-align: center;
            background: linear-gradient(135deg, var(--primary-green), var(--primary-blue));
            padding: 20px;
            border-radius: 12px 12px 0 0;
            color: white;
        }

        .profile-header img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
        }

        .profile-info {
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        .profile-info:last-child {
            border-bottom: none;
        }

        .profile-info i {
            color: var(--primary-blue);
            margin-right: 10px;
        }

        .btn-save {
            background: var(--primary-green);
            color: white;
            padding: 10px;
            width: 100%;
            border-radius: 8px;
            font-size: 16px;
            border: none;
            transition: 0.3s;
        }

        .btn-save:hover {
            background: var(--secondary-green);
        }
    </style>
</head>

<div class="profile-container">
    <div class="profile-header">
        <img src="{{ $user->picture ? asset('storage/' . $user->picture) : asset('images/default-profile.png') }}" alt="Profile Picture">
        <h2>Profil Saya</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="profile-info">
            <i class="fas fa-user"></i> <strong>Nama:</strong>
            <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}">
        </div>
    
        <div class="profile-info">
            <i class="fas fa-envelope"></i> <strong>Email:</strong>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
        </div>
    
        <div class="profile-info">
            <i class="fas fa-map-marker-alt"></i> <strong>Alamat:</strong>
            <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
        </div>
    
        <div class="profile-info">
            <i class="fas fa-phone"></i> <strong>Telepon:</strong>
            <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}">
        </div>
    
        <div class="profile-info">
            <i class="fas fa-key"></i> <strong>Password Baru:</strong>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password baru">
        </div>
    
        <div class="profile-info">
            <i class="fas fa-camera"></i> <strong>Foto Profil:</strong>
            <input type="file" name="picture" class="form-control">
        </div>
    
        <button type="submit" class="btn-save mt-3">Simpan Perubahan</button>
    </form>
</div>
@endsection

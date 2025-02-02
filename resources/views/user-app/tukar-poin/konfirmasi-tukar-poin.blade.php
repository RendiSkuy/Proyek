@extends('layout.main')

@section('title', 'Konfirmasi Tukar Poin | Bank Hijau Antapani')

@section('content')
<head>
    <style>
        :root {
            --primary-green: #2ECC71;
            --secondary-green: #27AE60;
            --primary-blue: #1E90FF;
            --secondary-blue: #1565C0;
            --background-light: #F8F9FA;
            --danger-red: #DC3545;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--background-light);
            color: #333;
        }

        .confirm-container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .confirm-header {
            text-align: center;
            font-weight: bold;
            font-size: 1.5rem;
            color: var(--primary-blue);
            margin-bottom: 20px;
        }

        .reward-image {
            width: 100%;
            max-height: 280px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .btn-confirm {
            background: var(--primary-blue);
            color: white;
            padding: 12px 20px;
            font-size: 1rem;
            border-radius: 30px;
            font-weight: bold;
            text-decoration: none;
            display: block;
            text-align: center;
            transition: 0.3s;
            margin-top: 20px;
            border: none;
            cursor: pointer;
        }

        .btn-confirm:hover {
            background: var(--secondary-blue);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .btn-disabled {
            background: var(--danger-red);
            cursor: not-allowed;
            opacity: 0.7;
        }

    </style>
</head>

<div class="confirm-container">
    <h2 class="confirm-header">Konfirmasi Tukar Poin</h2>

    <img src="{{ asset('storage/' . $reward->gambar) }}" alt="{{ $reward->nama_reward }}" class="reward-image">

    <div class="detail-item">
        <span><strong>Nama Pengguna</strong></span>
        <span>{{ auth()->user()->nama }}</span>
    </div>

    <div class="detail-item">
        <span><strong>Waktu Penukaran</strong></span>
        <span>{{ now()->format('d M Y, H:i') }}</span>
    </div>

    <div class="detail-item">
        <span><strong>Produk</strong></span>
        <span>{{ $reward->nama_reward }}</span>
    </div>

    <div class="detail-item">
        <span><strong>Stok Tersedia</strong></span>
        <span>{{ $reward->stok }}</span>
    </div>

    <div class="detail-item">
        <span><strong>Total Poin Dibutuhkan</strong></span>
        <span class="text-success">{{ number_format($reward->poin_dibutuhkan, 0, ',', '.') }} Poin</span>
    </div>

    <div class="detail-item">
        <span><strong>Poin Saya</strong></span>
        <span class="text-primary">{{ number_format($poin->jumlah, 0, ',', '.') }} Poin</span>
    </div>

    <div class="detail-item">
        <span><strong>Sisa Poin Setelah Penukaran</strong></span>
        <span class="{{ $point_left < 0 ? 'text-danger' : 'text-secondary' }}">
            {{ number_format($point_left, 0, ',', '.') }} Poin
        </span>
    </div>

    @if ($poin->jumlah < $reward->poin_dibutuhkan)
        <button class="btn-confirm btn-disabled">
            Poin Tidak Cukup <i class="bi bi-x-circle ms-1"></i>
        </button>
    @elseif ($reward->stok < 1)
        <button class="btn-confirm btn-disabled">
            Stok Tidak Tersedia <i class="bi bi-x-circle ms-1"></i>
        </button>
    @else
        <form action="{{ route('tukar-poin.store', $reward->id) }}" method="post">
            @csrf
            <button type="submit" class="btn-confirm">
                Konfirmasi Penukaran <i class="bi bi-check-circle ms-1"></i>
            </button>
        </form>
    @endif
</div>

@endsection

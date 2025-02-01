@extends('layout.main')

@section('title', 'Tukar Poin | Bank Hijau Antapani')

@section('content')
<head>
    <style>
        :root {
            --primary-green: #2ECC71;
            --secondary-green: #27AE60;
            --primary-blue: #1E90FF;
            --secondary-blue: #1565C0;
            --background-light: #F5F5F5;
        }

        .reward-container {
            max-width: 900px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
        }

        .reward-header {
            text-align: center;
            background: linear-gradient(135deg, var(--primary-green), var(--primary-blue));
            padding: 20px;
            border-radius: 12px 12px 0 0;
            color: white;
        }

        .reward-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }

        .reward-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: 0.3s;
            overflow: hidden;
        }

        .reward-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.2);
        }

        .reward-card img {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }

        .reward-card h6 {
            font-weight: bold;
            color: var(--primary-blue);
            margin: 10px 0 5px;
        }

        .reward-card p {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            .reward-list {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
        }
    </style>
</head>

<div class="reward-container">
    <div class="reward-header">
        <h3>Tukar Poin</h3>
        <p>Saldo Poin Anda: <strong>{{ $nasabah->poin->jumlah ?? 0 }}</strong></p>
    </div>

    @foreach (['hiasan' => $hiasan, 'peralatan' => $peralatan, 'perlengkapan' => $perlengkapan] as $kategori => $items)
        <div class="reward-section">
            <h5 class="fw-bold text-primary mt-3">{{ ucfirst($kategori) }}</h5>
            <div class="reward-list">
                @forelse ($items as $reward)
                    <a href="{{ route('tukar-poin.show', $reward->id) }}" class="text-decoration-none">
                        <div class="reward-card">
                            <img src="{{ $reward->image ? asset('storage/' . $reward->image) : asset('images/default.png') }}" alt="{{ $reward->nama_reward }}">
                            <h6>{{ number_format($reward->poin_dibutuhkan, 0, ',', '.') }} Poin</h6>
                            <p>{{ $reward->nama_reward }}</p>
                        </div>
                    </a>
                @empty
                    <p class="text-muted">Belum ada hadiah dalam kategori ini.</p>
                @endforelse
            </div>
        </div>
    @endforeach
</div>
@endsection

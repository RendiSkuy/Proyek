@extends('layout.main')

@section('title', 'Kategori Sampah')

@section('content')
<head>
    <style>
        /* Gradient Header */
        .header-kategori {
            background: linear-gradient(135deg, #28a745, #007bff);
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 15px 15px 0 0;
        }

        /* Kategori Sampah */
        .kategori-container {
            width: 100%;
            max-width: 1100px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .kategori-title {
            font-weight: bold;
            color: #007bff;
            border-bottom: 3px solid #007bff;
            display: inline-block;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        .card-sampah {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .card-sampah:hover {
            transform: translateY(-5px);
        }

        .card-sampah img {
            width: 100%;
            height: 140px;
            object-fit: cover;
        }

        .card-sampah .card-body {
            text-align: center;
            padding: 10px;
        }

        .harga-text {
            font-weight: bold;
            color: #28a745;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .kategori-container {
                padding: 15px;
                border-radius: 0;
            }
        }
    </style>
</head>

<!-- HEADER -->
<div class="header-kategori">
    <h4 class="fw-bold">KATEGORI PEMILAHAN SAMPAH</h4>
</div>

<!-- CONTAINER -->
<div class="kategori-container">
    @foreach ($kategoriSampahs as $kategori)
        <h5 class="kategori-title">{{ $kategori->nama_kategori }}</h5>
        <div class="row">
            @forelse ($kategori->sampahs as $sampah)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card card-sampah">
                        <img src="{{ asset('storage/' . $sampah->gambar) }}" alt="{{ $sampah->nama }}">
                        <div class="card-body">
                            <p class="harga-text">Rp.{{ number_format($sampah->harga_per_kg, 0, ',', '.') }} /Kg</p>
                            <p class="text-muted">{{ $sampah->nama }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">Belum ada sampah dalam kategori ini.</p>
            @endforelse
        </div>
    @endforeach
</div>
@endsection

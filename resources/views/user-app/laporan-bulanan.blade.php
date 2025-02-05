@extends('layout.main')

@section('title', 'Laporan Bulanan')

@section('content')

<div class="container">
    <h3 class="fw-bold mt-3">Laporan Bulanan - {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</h3>

    <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>

    <div class="card shadow-sm p-3 mb-3">
        <h5 class="fw-bold">Total Setoran Sampah Bulan Ini</h5>
        <p class="fs-4 fw-bold text-primary">{{ number_format($totalSetoran->total_berat ?? 0, 2) }} Kg</p>
    </div>

    <table class="table table-bordered">
        <thead class="table-success">
            <tr>
                <th>Tanggal</th>
                <th>Jenis Sampah</th>
                <th>Berat (Kg)</th>
                <th>Total Poin</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksiBulanan as $transaksi)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d M Y') }}</td>
                    <td>
                        @foreach ($jenisSampah->where('transaksi_id', $transaksi->id) as $sampah)
                            {{ $sampah->nama }} ({{ $sampah->berat }} Kg) <br>
                        @endforeach
                    </td>
                    <td>{{ number_format($transaksi->total_berat, 2) }}</td>
                    <td>{{ number_format($transaksi->total_poin) }}</td>
                    <td>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada transaksi bulan ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

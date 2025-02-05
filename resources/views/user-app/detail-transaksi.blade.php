@extends('layout.main')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container">
    <a href="{{ route('transaction.history') }}" class="btn btn-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <div class="card shadow-sm p-3">
        <h5 class="text-uppercase fw-bold">DETAIL TRANSAKSI</h5>

        <div class="d-flex justify-content-between align-items-center">
            <span class="badge bg-primary text-white">ID {{ $transaction->kode_transaksi }}</span>
        </div>

        <!-- Informasi Penukar dan Pengambil -->
        <div class="mt-3">
            <p class="fw-bold text-muted mb-0">Sampah ditukarkan oleh</p>
            <p class="fw-bold">{{ $transaction->nasabah->nama }}</p>
            <p class="text-muted">{{ \Carbon\Carbon::parse($transaction->created_at)->format('h:i A') }} - {{ \Carbon\Carbon::parse($transaction->tanggal)->format('d M Y') }}</p>
        </div>

        <div class="mt-3">
            <p class="fw-bold text-muted mb-0">Sampah diambil oleh</p>
            <p class="fw-bold">{{ $transaction->admin->nama ?? 'Petugas Bank Sampah' }}</p>
            <p class="text-muted">{{ \Carbon\Carbon::parse($transaction->tanggal)->format('h:i A') }} - {{ \Carbon\Carbon::parse($transaction->tanggal)->format('d M Y') }}</p>
        </div>

        <!-- Jenis Sampah -->
        <h6 class="fw-bold text-muted mt-3">Jenis Sampah</h6>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    @foreach ($transaction->details as $detail)
                        <tr>
                            <td>
                                <p class="fw-bold mb-0">{{ $detail->sampah->nama }}</p>
                                <small class="text-muted">{{ $detail->sampah->kategori }}</small>
                            </td>
                            <td class="text-end">
                                <p class="fw-bold mb-0">{{ $detail->berat }} Kg</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-muted">
                                Harga per Kg: Rp {{ number_format($detail->sampah->harga_per_kg, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total Pendapatan dan Poin -->
        <div class="d-flex justify-content-between">
            <h6 class="fw-bold">Total Pendapatan</h6>
            <h6 class="fw-bold">Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</h6>
        </div>
        <div class="d-flex justify-content-between">
            <h6 class="fw-bold">Jumlah Poin Didapat</h6>
            <h6 class="fw-bold text-success">{{ number_format($transaction->total_poin, 0, ',', '.') }} pts</h6>
        </div>
    </div>
</div>
@endsection

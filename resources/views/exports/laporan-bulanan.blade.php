<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Bulanan - Bank Sampah Hijau</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #4CAF50; color: white; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Laporan Bulanan Bank Sampah Hijau</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Nasabah</th>
                <th>Bulan</th>
                <th>Total Berat (Kg)</th>
                <th>Total Harga (Rp)</th>
                <th>Total Poin</th>
                <th>Keuntungan Bank (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporans as $laporan)
                <tr>
                    <td>{{ $laporan->nasabah->nama }}</td>
                    <td>{{ \Carbon\Carbon::parse($laporan->bulan)->format('F Y') }}</td>
                    <td>{{ $laporan->total_berat }} Kg</td>
                    <td>Rp {{ number_format($laporan->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $laporan->total_poin }}</td>
                    <td>Rp {{ number_format($laporan->keuntungan_bank, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

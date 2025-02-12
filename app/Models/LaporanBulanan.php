<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBulanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nasabah_id',
        'bulan',
        'total_berat',
        'total_harga',
        'total_poin',
        'keuntungan_bank',
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }

    public static function hitungKeuntungan($total_harga)
    {
        $persentase_keuntungan = 0.1; // 10% keuntungan untuk bank
        return $total_harga * $persentase_keuntungan;
    }

    public static function generateLaporan($nasabah_id, $bulan)
    {
        $transaksi = Transaksi::where('nasabah_id', $nasabah_id)
            ->whereMonth('tanggal', date('m', strtotime($bulan)))
            ->whereYear('tanggal', date('Y', strtotime($bulan)))
            ->get();

        if ($transaksi->isEmpty()) {
            return [
                'total_berat' => 0,
                'total_harga' => 0,
                'total_poin' => 0,
                'keuntungan_bank' => 0,
            ];
        }

        $total_berat = $transaksi->sum('total_berat');
        $total_harga = $transaksi->sum('total_harga');
        $total_poin = $transaksi->sum('total_poin');
        $keuntungan_bank = self::hitungKeuntungan($total_harga);

        return [
            'total_berat' => $total_berat,
            'total_harga' => $total_harga,
            'total_poin' => $total_poin,
            'keuntungan_bank' => $keuntungan_bank,
        ];
    }
}

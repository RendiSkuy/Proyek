<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'sampah_id',
        'berat',
        'harga',
        'poin',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($detail) {
            $sampah = Sampah::find($detail->sampah_id);

            if ($sampah) {
                $detail->harga = $detail->berat * $sampah->harga_per_kg;
                $detail->poin = $detail->berat * $sampah->poin_per_kg;
            }
        });

        static::saved(function ($detail) {
            if (!$detail->wasRecentlyCreated) {
                $detail->transaksi->updateTotals();
                Poin::updatePoin($detail->transaksi->nasabah_id);
            }
        });

        static::deleted(function ($detail) {
            $detail->transaksi->updateTotals();
            Poin::updatePoin($detail->transaksi->nasabah_id);
        });
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    public function sampah()
    {
        return $this->belongsTo(Sampah::class, 'sampah_id')->select(['id', 'nama', 'harga_per_kg', 'poin_per_kg']);
    }

    /**
     * Ambil daftar sampah yang telah disetor oleh nasabah dalam bulan tertentu
     */
    public static function getJenisSampahBulanan($nasabah_id, $bulan = null)
    {
        $bulan = $bulan ?? now()->format('Y-m');

        return self::whereHas('transaksi', function ($query) use ($nasabah_id, $bulan) {
                $query->where('nasabah_id', $nasabah_id)
                    ->where('tanggal', 'like', "$bulan%");
            })
            ->join('sampahs', 'transaksi_details.sampah_id', '=', 'sampahs.id')
            ->select('sampahs.nama', 'transaksi_details.berat', 'transaksi_details.harga', 'transaksi_details.poin')
            ->get();
    }
}

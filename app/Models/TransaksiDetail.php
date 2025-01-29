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

        // Event sebelum detail transaksi disimpan
        static::saving(function ($detail) {
            $sampah = Sampah::find($detail->sampah_id);

            if ($sampah) {
                $detail->harga = $detail->berat * $sampah->harga_per_kg;
                $detail->poin = $detail->berat * $sampah->poin_per_kg;
            }
        });

        // Event setelah detail transaksi disimpan
        static::saved(function ($detail) {
            // Update total di tabel transaksi
            $detail->transaksi->updateTotals();
        });

        // Event setelah detail transaksi dihapus
        static::deleted(function ($detail) {
            // Update total di tabel transaksi
            $detail->transaksi->updateTotals();
        });
    }

    // Relasi ke transaksi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    // Relasi ke sampah
    public function sampah()
    {
        return $this->belongsTo(Sampah::class, 'sampah_id');
    }
}

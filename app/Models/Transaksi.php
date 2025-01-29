<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nasabah_id',
        'kode_transaksi',
        'total_berat',
        'total_harga',
        'total_poin',
        'tanggal',
        'keterangan',
        'status',
    ];

    protected static function booted()
    {
        static::creating(function ($transaksi) {
            if (empty($transaksi->kode_transaksi)) {
                $transaksi->kode_transaksi = 'TRX-' . now()->format('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(6));
            }
        });
    }

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }

    public function details()
    {
        return $this->hasMany(TransaksiDetail::class);
    }

    /**
     * Update total berat, harga, dan poin berdasarkan detail transaksi.
     */
    public function updateTotals(): void
    {
        $this->total_berat = $this->details->sum('berat');
        $this->total_harga = $this->details->sum('harga');
        $this->total_poin = $this->details->sum('poin');
        $this->save();
    }
}



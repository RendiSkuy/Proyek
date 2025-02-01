<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';

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

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'nasabah_id')->select(['id', 'nama']);
    }

    public function details()
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id');
    }

    protected static function booted()
    {
        static::creating(function ($transaksi) {
            if (empty($transaksi->kode_transaksi)) {
                $transaksi->kode_transaksi = 'TRX-' . now()->format('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(6));
            }
        });

        static::saved(function ($transaksi) {
            if ($transaksi->wasRecentlyCreated) {
                Poin::updatePoin($transaksi->nasabah_id);
            }
        });

        static::deleted(function ($transaksi) {
            Poin::updatePoin($transaksi->nasabah_id);
        });
    }

    public function updateTotals(): void
    {
        $totalBerat = $this->details()->sum('berat');
        $totalHarga = $this->details()->sum('harga');
        $totalPoin = $this->details()->sum('poin');

        if ($this->total_berat != $totalBerat || $this->total_harga != $totalHarga || $this->total_poin != $totalPoin) {
            $this->update([
                'total_berat' => $totalBerat,
                'total_harga' => $totalHarga,
                'total_poin' => $totalPoin,
            ]);
        }
    }
}

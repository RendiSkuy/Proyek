<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
    public function scopeForNasabah($query, $nasabah_id)
    {
        return $query->where('nasabah_id', $nasabah_id);
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

    /**
     * Ambil laporan bulanan berdasarkan nasabah
     */
    public static function getLaporanBulanan($nasabah_id, $bulan = null)
    {
        $bulan = $bulan ?? Carbon::now()->format('Y-m'); // Default bulan ini

        return self::where('nasabah_id', $nasabah_id)
            ->where('tanggal', 'like', "$bulan%")
            ->get();
    }

    /**
     * Hitung total berat, harga, dan poin per bulan
     */
    public static function getTotalSetoranBulanan($nasabah_id, $bulan = null)
    {
        $bulan = $bulan ?? Carbon::now()->format('Y-m'); // Default bulan ini

        return self::where('nasabah_id', $nasabah_id)
            ->where('tanggal', 'like', "$bulan%")
            ->selectRaw('SUM(total_berat) as total_berat, SUM(total_harga) as total_harga, SUM(total_poin) as total_poin')
            ->first();
    }
}

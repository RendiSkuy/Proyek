<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        'status'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Generate kode transaksi otomatis
            $model->kode_transaksi = 'TRX-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));
            
            // Set tanggal otomatis jika tidak diset
            $model->tanggal = $model->tanggal ?? now()->format('Y-m-d');
        });
    }

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'nasabah_id');
    }

    public function details()
    {
        return $this->hasMany(TransaksiDetail::class);
    }
}
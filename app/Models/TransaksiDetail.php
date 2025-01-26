<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;

    protected $fillable = ['transaksi_id', 'sampah_id', 'berat', 'harga'];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    public function sampah()
    {
        return $this->belongsTo(Sampah::class, 'sampah_id');
    }
}


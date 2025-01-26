<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poin extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_poin',
        'deskripsi',
        'jumlah',
        'kategori',
        'nasabah_id' // tambahkan ini jika belum ada
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }
}
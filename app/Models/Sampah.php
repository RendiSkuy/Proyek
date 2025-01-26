<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model
    protected $table = 'sampah';

    // Kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'kategori_sampah_id',
        'nama',
        'deskripsi', // Tambahkan deskripsi ke fillable
        'harga_per_kg',
        'poin_per_kg', // Tambahkan poin_per_kg ke fillable
        'gambar' // Jika ingin menggunakan kolom gambar
    ];

    // Relasi dengan model KategoriSampah
    public function kategori()
    {
        return $this->belongsTo(KategoriSampah::class, 'kategori_sampah_id');
    }
}

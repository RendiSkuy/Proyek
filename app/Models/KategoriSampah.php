<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSampah extends Model
{
    use HasFactory;

    // Tentukan nama tabel secara eksplisit
    protected $table = 'kategori_sampah';

    // Kolom yang dapat diisi
    protected $fillable = ['nama_kategori', 'deskripsi', 'jenis', 'poin_per_kg'];

    // Relasi ke model Sampah
    public function sampahs()
    {
        return $this->hasMany(Sampah::class);
    }
}

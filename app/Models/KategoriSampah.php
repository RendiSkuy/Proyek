<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriSampah extends Model
{
    use HasFactory;
    
    protected $fillable = ['nama_kategori', 'deskripsi', 'jenis', 'poin_per_kg', 'gambar'];


    public function poins(): BelongsToMany
    {
        return $this->belongsToMany(Poin::class, 'kategori_sampah_poin', 'kategori_sampah_id', 'poin_id');
    }

    public function sampahs(): HasMany
    {
        return $this->hasMany(Sampah::class, 'kategori_sampah_id');
    }
}







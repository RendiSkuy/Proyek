<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sampah extends Model
{
    use HasFactory;

    protected $fillable = ['kategori_sampah_id', 'nama', 'deskripsi', 'harga_per_kg', 'poin_per_kg', 'gambar'];


    public function kategoriSampah(): BelongsTo
    {
        return $this->belongsTo(KategoriSampah::class, 'kategori_sampah_id');
    }

    public function poins(): BelongsToMany
    {
        return $this->belongsToMany(Poin::class, 'sampah_poin', 'sampah_id', 'poin_id');
    }
}







<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Poin extends Model
{
    use HasFactory;

    protected $fillable = ['nasabah_id', 'jumlah']; // Pastikan 'jumlah' ada di sini

    public function nasabah(): BelongsTo
    {
        return $this->belongsTo(Nasabah::class);
    }

    public function kategoriSampahs(): BelongsToMany
    {
        return $this->belongsToMany(KategoriSampah::class, 'kategori_sampah_poin', 'poin_id', 'kategori_sampah_id');
    }

    public function sampahs(): BelongsToMany
    {
        return $this->belongsToMany(Sampah::class, 'sampah_poin', 'poin_id', 'sampah_id');
    }
}





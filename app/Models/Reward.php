<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

    protected $fillable = ['nama_reward', 'deskripsi', 'poin_dibutuhkan', 'stok', 'kategori', 'gambar'];

    public function getImageUrlAttribute()
    {
        return $this->gambar ? asset('storage/' . $this->gambar) : asset('images/default.png');
    }
}

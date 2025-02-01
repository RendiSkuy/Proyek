<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TukarPoin extends Model
{
    use HasFactory;

    protected $table = 'tukar_poins';

    protected $fillable = ['nasabah_id', 'reward_id', 'jumlah', 'status', 'tanggal_tukar'];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'nasabah_id');
    }

    public function reward()
    {
        return $this->belongsTo(Reward::class, 'reward_id');
    }
}

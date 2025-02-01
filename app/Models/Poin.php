<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poin extends Model
{
    use HasFactory;

    protected $fillable = ['nasabah_id', 'jumlah'];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'nasabah_id')->select(['id', 'nama']);
    }

    public static function updatePoin($nasabah_id)
    {
        $totalPoin = Transaksi::where('nasabah_id', $nasabah_id)->sum('total_poin');

        $poin = self::firstOrNew(['nasabah_id' => $nasabah_id]);
        if ($poin->jumlah != $totalPoin) {
            $poin->jumlah = $totalPoin;
            $poin->save();
        }
    }
}

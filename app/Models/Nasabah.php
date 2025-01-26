<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'password',
        'alamat',
        'telepon',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function poins()
    {
        return $this->hasMany(Poin::class);
    }
    public function nasabah()
{
    return $this->hasOne(Nasabah::class);
}
}

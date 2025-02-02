<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Gunakan Authenticatable
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Nasabah extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'alamat',
        'telepon',
        'foto',
        
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function poins()
    {
        return $this->hasMany(Poin::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'nasabah_id');
    }
}

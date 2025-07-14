<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $fillable = [
        'name',
        'alamat',
        'latitude',
        'longitude',
        'no_telp',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function perangkats()
    {
        return $this->hasMany(Perangkat::class);
    }

    public function billings()
    {
        return $this->hasManyThrough(Billing::class, Perangkat::class);
    }
}

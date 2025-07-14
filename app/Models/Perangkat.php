<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perangkat extends Model
{
    protected $fillable = [
        'nama',
        'tipe',
        'status',
        'harga_per_jam',
        'cabang_id',
    ];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }

    public function billings()
    {
        return $this->hasMany(Billing::class);
    }

    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $fillable = [
        'user_id',
        'perangkat_id',
        'durasi',
        'total_harga',
        'status',
        'photo_url',
        'start_time',
        'end_time',
        'nama_pelanggan',
        'jenis_pembayaran',
    ];

    public function perangkat()
    {
        return $this->belongsTo(Perangkat::class);
    }

    public function kasir()
    {
        return $this->belongsTo(User::class, 'kasir_id');
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }


}

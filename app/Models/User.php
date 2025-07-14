<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'no_telp',
        'role',
        'cabang_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeKasir($query)
    {
        return $query->where('role', 'kasir');
    }

    public function scopeSuperAdmin($query)
    {
        return $query->where('role', 'superadmin');
    }


    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cabang;

class CabangSeeder extends Seeder
{
    public function run(): void
    {
        Cabang::create([
            'name' => 'Cabang Utama',
            'alamat' => 'Kasihan',
            'no_telp' => '08123456789',
            'latitude' => -6.200000,
            'longitude' => 106.816666,
        ]);
        
    }
}

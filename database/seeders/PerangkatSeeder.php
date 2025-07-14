<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Perangkat;

class PerangkatSeeder extends Seeder
{
    public function run(): void
    {
        Perangkat::create([
            'nama' => 'PS5 - Meja 1',
            'cabang_id' => 1,
            'harga_per_jam' => 10000,
            'tipe' => 'ps',

        ]);

        Perangkat::create([
            'nama' => 'PS5 - Meja 2',
            'cabang_id' => 1,
            'harga_per_jam' => 10000,
            'tipe' => 'ps',

        ]);
    }
}

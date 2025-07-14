<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CabangSeeder::class,
            UserSeeder::class,
            PerangkatSeeder::class,
            BillingSeeder::class,
        ]);
    }
}

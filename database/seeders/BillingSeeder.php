<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Billing;
use Carbon\Carbon;

class BillingSeeder extends Seeder
{
    public function run(): void
    {
        Billing::create([
            'user_id' => 3, 
            'perangkat_id' => 1,
            'start_time' => Carbon::now()->subHour(),
            'end_time' => Carbon::now(),
            'status' => 'completed',
            'photo_url' => 'https://example.com/photo.jpg',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Kiosk;
use Illuminate\Database\Seeder;

class KioskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kiosk::factory()->count(10)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\KioskParticipant;
use Illuminate\Database\Seeder;

class KioskParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kioskParticipants = KioskParticipant::factory()->count(5)->create();
    }
}

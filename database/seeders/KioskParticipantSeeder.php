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
        // Kiosk participant as a vendor
        KioskParticipant::factory()->create([
            'user_id' => 4,
        ]);

        // Kiosk participant as a student
        KioskParticipant::factory()->create([
            'user_id' => 5,
        ]);

        $kioskParticipants = KioskParticipant::factory()->count(5)->create();
        foreach ($kioskParticipants as $kioskParticipant) {
            $kioskParticipant->user->assignRole('Kiosk Participant');
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::factory()->create([
            'kiosk_participant_id' => 2,
        ]);

        $students = Student::factory()->count(5)->create();
        foreach ($students as $student) {
            $student->kioskParticipant->user->assignRole('Kiosk Participant');
        }
    }
}

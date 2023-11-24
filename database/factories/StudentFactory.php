<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\KioskParticipant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kiosk_participant_id' => KioskParticipant::factory(),
            'course_id' => Course::inRandomOrder()->pluck('id')->first(),
            'matric_no' => $this->faker->bothify('CB20###'),
            'year' => $this->faker->numberBetween(1, 4),
            'semester' => $this->faker->numberBetween(1, 3),
        ];
    }
}

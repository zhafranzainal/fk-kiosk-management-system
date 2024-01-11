<?php

namespace Database\Factories;

use App\Models\KioskParticipant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Complaint>
 */
class ComplaintFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kiosk_participant_id' => KioskParticipant::inRandomOrder()->pluck('id')->first(),
            'user_id' => KioskParticipant::inRandomOrder()->pluck('id')->first(),
            'description' => $this->faker->sentence(),
            'assign_to' => $this->faker->name(),
            'status' => 'In Progress',
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Bank;
use App\Models\Kiosk;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KioskParticipant>
 */
class KioskParticipantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'kiosk_id' => Kiosk::inRandomOrder()->pluck('id')->first(),
            'bank_id' => Bank::inRandomOrder()->pluck('id')->first(),
            'account_no' => $this->faker->bankAccountNumber(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Kiosk;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'transaction_id' => Transaction::inRandomOrder()->pluck('id')->first(),
            'kiosk_id' => Kiosk::inRandomOrder()->pluck('id')->first(),
            'user_id' => User::inRandomOrder()->pluck('id')->first(),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'status' => 'Pending',
        ];
    }
}

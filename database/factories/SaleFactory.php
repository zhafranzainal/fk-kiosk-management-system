<?php

namespace Database\Factories;

use App\Models\KioskParticipant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
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
            'monthly_revenue' => $this->faker->randomFloat(2, 500, 10000),
            'cost_of_goods_sold' => $this->faker->randomFloat(2, 500, 10000),
            'profit' => $this->faker->randomFloat(2, 500, 10000),
            'status' => 'Active',
        ];
    }
}

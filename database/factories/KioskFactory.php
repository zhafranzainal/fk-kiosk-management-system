<?php

namespace Database\Factories;

use App\Models\BusinessType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kiosk>
 */
class KioskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'business_type_id' => BusinessType::inRandomOrder()->pluck('id')->first(),
            'name' => $this->faker->word(),
            'location' => $this->faker->sentence(),
            'suggested_action' => 'No Action',
            'comment' => $this->faker->sentence(),
            'status' => 'Inactive',
        ];
    }
}

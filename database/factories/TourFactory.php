<?php

namespace Database\Factories;

use App\Models\Travel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tour>
 */
class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->text(10),
            'travel_id' => Travel::factory(),
            'starting_date' => now()->subDays(rand(1, 10)),
            'ending_date' => now()->addDays(rand(1, 10)),
            'price_in_cents' => fake()->randomFloat(2, 10, 999)
        ];
    }
}

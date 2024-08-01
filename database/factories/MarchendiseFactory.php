<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Marchendise>
 */
class MarchendiseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date_start' => fake()->dateTimeBetween('-2 years', '-1 years'),
            'date_end' => fake()->dateTimeBetween('-1 years', 'now'),
            'quota' => fake()->numberBetween(5,10),
            'employee_id' => fake()->numberBetween(1,3),
        ];
    }
}

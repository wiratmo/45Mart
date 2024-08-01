<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MemberPointFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date_at'=> fake()->dateTimeBetween('-11 months', '-3 months'),
            'status' => 'alive',
            'employee_id' => fake()->numberBetween(1,5)
        ];
    }
}

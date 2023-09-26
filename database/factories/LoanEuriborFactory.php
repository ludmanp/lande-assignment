<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LoanEuribor>
 */
class LoanEuriborFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'segment_nr' => fake()->numberBetween('3', '36'),
            'rate_in_basis_points' => fake()->numberBetween('50', '2000'),
        ];
    }
}

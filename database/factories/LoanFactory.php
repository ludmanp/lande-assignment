<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loan>
 */
class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount_in_cents' => fake()->numberBetween('10000', '10000000'),
            'term' => fake()->numberBetween('3', '36'),
            'interest_rate_in_basis_points' => fake()->numberBetween('50', '2000'),
        ];
    }
}

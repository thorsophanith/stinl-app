<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\standardparameter>
 */
class StandardParameterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'standard_id' => $this->faker->numberBetween(1, 7), // IDs from 1 to 7
            'parameter_id' => $this->faker->numberBetween(1, 8), // IDs from 1 to 8
        ];
    }
}

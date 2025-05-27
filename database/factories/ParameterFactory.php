<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\parameter>
 */
class ParameterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_en' => $this->faker->word(),
            'name_kh' => 'ឈ្មោះប៉ារ៉ាម៉ែត្រខ្មែរ', // Or use translated versions if needed
            'formular' => 'C6H12O6', // Example default
            'criteria_operator' => $this->faker->randomElement(['>=', '<=', '=', 'between']),
            'criteria_value1' => $this->faker->randomFloat(2, 0, 100),
            'criteria_value2' => null, // Add logic if operator is "between"
            'unit' => $this->faker->randomElement(['mg/kg', 'g/100g', '%', 'pH']),
            'LOQ' => $this->faker->randomFloat(2, 0.01, 1.0),
            'method' => $this->faker->randomElement(['HPLC', 'ICP-MS', 'Kjeldahl', 'pH Meter']),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Measurement>
 */
class MeasurementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'bust' => fake()->randomFloat(2,25,35),
            // 'cloth-type' => fake()->randomElement(['shirt', 'polo', 'gown', 'trouser', '']),
            // 'chest' => fake()->randomFloat(2, 25, 35),
            // 'neck' => fake()->randomFloat(2, 25, 35),
            // 'waist' => fake()->randomFloat(2, 25, 35),
            // 'hips' => fake()->randomFloat(2, 35, 45),
            // 'shoulder_width' => fake()->randomFloat(2, 15, 20),
            // 'sleeve_length' => fake()->randomFloat(2, 15, 20),
            // 'sleeve_opening' => fake()->randomFloat(2, 15, 20),
            // 'arm_length' => fake()->randomFloat(2, 25, 30),
            // 'inseam' => fake()->randomFloat(2, 30, 35),
            // 'outseam' => fake()->randomFloat(2, 30, 35),
            // 'rise' => fake()->randomFloat(2, 30, 35),
            // 'length' => fake()->randomFloat(2, 30, 35),
            // 'height' => fake()->randomFloat(2, 150, 180),
            // 'weight' => fake()->randomFloat(2, 50, 100),
        ];
    }
}
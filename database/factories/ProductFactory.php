<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->words(2, true), 
            "price" => $this->faker->numberBetween(1000, 100000),
            "description" => $this->faker->text(200),   
            "stock" => $this->faker->numberBetween(1, 100),
        ];
    }
}

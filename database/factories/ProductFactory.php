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
        $purchase = $this->faker->randomFloat(2, 1, 20);
        $sell = $purchase + $this->faker->randomFloat(2, 0.20, 0.50);

        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'stock' => $this->faker->numberBetween(1, 50),
            'purchase' => $purchase,
            'sell' => $sell,
        ];
    }
}

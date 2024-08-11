<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'name' => $this->faker->name(),
            'dni' => $this->faker->randomNumber(8,true),// que tenga 7 digitos habilitado
            'number' => $this->faker->randomNumber(9,true),// que tenga 9 digitos habilitado
        ];
    }
}

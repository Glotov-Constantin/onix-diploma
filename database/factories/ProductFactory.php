<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->text,
            'in_stock' => $this->faker->numerify,
            'rating' => $this->faker->numberBetween(1, 5)
        ];
    }
}

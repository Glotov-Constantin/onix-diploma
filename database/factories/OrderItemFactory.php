<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'order_id' => $this->faker->numberBetween(1, 200),
            'product_id' => $this->faker->numberBetween(1,400),
            'price' => $this->faker->numberBetween(100, 5000),
            'quantity' => $this->faker->numberBetween(1, 3)
        ];
    }
}

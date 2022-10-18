<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCategoryFactory extends Factory
{
    public $product_id = 0;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->product_id++;
        return [
            'product_id' => $this->product_id,
            'category_id' => $this->faker->numberBetween(1, 20),
        ];
    }
}

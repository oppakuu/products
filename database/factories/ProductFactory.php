<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

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
            Product::NAME => $this->faker->name(),
            Product::DESCRIPTION => $this->faker->text(50),
            Product::AUTHOR_ID => rand(1, 10),
            Product::CREATED_AT => now(),
        ];
    }
}

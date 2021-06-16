<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'seller_id' => 2,
            'name' => $this->faker->name,
            'price' => $this->faker->numberBetween(100, 500),
            'quantity' => $this->faker->numberBetween(10, 50),
        ];
    }
}

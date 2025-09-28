<?php

namespace Database\Factories;

use App\Models\Product\Category;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{

    protected $model = Product::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'        => $this->faker->words(3, true), 
            'description' => $this->faker->sentence(),
            'price'       => $this->faker->randomFloat(2, 10, 2000),
            'stock'       => $this->faker->numberBetween(0, 100),
            'category_id' => Category::factory(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MetaProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'attributes' => [
                'size' => $this->faker->numberBetween(35, 46),
                'color' => $this->faker->safeColorName(),
                'code' => $this->faker->uuid(),
                'brand' => $this->faker->company(),
            ],
            'product_id' => Product::factory(),
        ];
    }
}

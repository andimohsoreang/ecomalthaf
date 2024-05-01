<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Subcategory;
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

            'productname' => fake()->unique()->streetName(),
            'productcode' => fake()->unique()->numberBetween(0,100),
            'productweight' => fake()->unique()->phoneNumber(),
            'subcategory_id' => Subcategory::factory(),
            'brand_id' => Brand::factory(),
            'stock' => fake()->unique()->numberBetween(0,9999),
            'desc' => fake()->unique()->text(),
            'price' => fake()->unique()->numberBetween(10000,900000)
        ];
    }
}

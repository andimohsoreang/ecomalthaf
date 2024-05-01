<?php

namespace Database\Factories;

use App\Models\Product;
use Faker\Core\File;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductPicture>
 */
class ProductPicturesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate a random image name
        $imageName = $this->faker->word() . '.png';

        // Generate image content
        $imageContent = file_get_contents($this->faker->imageUrl(400, 300));

        // Save image to storage
        $path = 'images-product/' . $imageName;
        Storage::put($path, $imageContent);
        return [
            'product_id' => Product::factory(),
            'url' => $path
            
        ];
    }
}

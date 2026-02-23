<?php

namespace Database\Factories;

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
        $price = $this->faker->numberBetween(100, 10000);
        return [
            'p_name' => $this->faker->word,
            'p_desc' => $this->faker->paragraph,
            'p_price' => $price,
            'p_offerprice' => $this->faker->numberBetween(10, $price),
            'p_imgs' => json_encode(['image1.jpg', 'image2.jpg']), // Generate a JSON string
            'p_stock' => $this->faker->numberBetween(0, 100),
        ];
    }
}

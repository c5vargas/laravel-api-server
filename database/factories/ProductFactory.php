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
        $keywords = str_replace(' ', ',', $this->faker->text(10));

        return [
            'title' => $this->faker->name(),
            'description' => $this->faker->text(200),
            'colors' => $this->faker->safeHexColor(),
            'keywords' => $keywords,
            'shop_link' => $this->faker->url(),
            'slug' => $this->faker->slug(12)
        ];
    }
}

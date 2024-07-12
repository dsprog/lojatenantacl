<?php

namespace Database\Factories;

use Illuminate\Support\Str;
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
        $nameProduct = $this->faker->word;
        return [
            'name' => $nameProduct,
            'description' => $this->faker->sentence,
            'price'  => $this->faker->numberBetween(1, 5000),
            'body'   => $this->faker->paragraphs(5, true),
            'slug'   => Str::slug($nameProduct)
        ];
    }
}

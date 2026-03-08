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
        $name = fake()->unique()->word();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'image' => 'https://picsum.photos/seed/' . Str::random(10) . '/600/600',
            'price' => random_int(5_000, 400_000),
            'about' => fake()->text(50),
            'category_id' => random_int(1, 50),
        ];
    }
}

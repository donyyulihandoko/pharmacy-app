<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'slug' => Str::slug('name'),
            'icon' => 'https://picsum.photos/seed/' . Str::random(10) . '/600/600',
            'description' => fake()->text(50),
            'is_active' => true
        ];
    }
}

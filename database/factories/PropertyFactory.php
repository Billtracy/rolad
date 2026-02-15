<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'slug' => Str::slug($this->faker->unique()->sentence(3)),
            'description' => $this->faker->paragraph,
            'location' => $this->faker->address,
            'price' => $this->faker->numberBetween(1000000, 50000000),
            'type' => $this->faker->randomElement(['land', 'house', 'apartment']),
            'status' => 'available',
            'features' => ['Water', 'Electricity'],
            'images' => ['https://via.placeholder.com/800'],
            'is_featured' => $this->faker->boolean,
        ];
    }
}

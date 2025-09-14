<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Models\Book\Book>
 */
class BookFactory extends Factory
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
            'author' => $this->faker->name(),
            'category_id' => \App\Models\Category::factory(),
            'total_copies' => $this->faker->numberBetween(1, 10),
            'available_copies' => $this->faker->numberBetween(1, 10),
        ];
        
    }
}

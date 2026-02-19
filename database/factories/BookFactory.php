<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
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
            'title' => fake()->sentence(),
            'isbn' => fake()->unique()->isbn13(),
            'description' => fake()->paragraph(),
            'publisher_date' => fake()->date(),
            'page_count' => fake()->numberBetween(50, 1000),
            'language' => fake()->languageCode(['en', 'ar']),
            'edition' => fake()->numberBetween(1, 5),
            'total_copies' => fake()->numberBetween(1, 100),
            'author_id'      => Author::factory(), 
            'publisher_id'   => Publisher::factory(), 
            'status' =>  fake()->randomElement(['available', 'borrowed', 'reserved', 'archived']),
        ];
    }
}

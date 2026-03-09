<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $rand  = [Member::all()->random()->id, Book::all()->random()->id];
        return [
            // 'reviewable_id' => fake()->numberBetween(1, 20),

            // 'reviewable_type' => fake()->randomElement([
            //     '\App\Models\Book',
            //     '\App\Models\Author'
            // ]),

            'member_id' => Member::all()->random()->id,
            'rating' => fake()->numberBetween(1, 5),
            'comment' => fake()->sentence(3),
        ];
    }
}

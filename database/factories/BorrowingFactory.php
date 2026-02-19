<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrowing>
 */
class BorrowingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $borrowedAt = fake()->dateTimeBetween('-1 month', 'now');

        $dueDate = Carbon::instance($borrowedAt)->addDays(14);

        $status = fake()->randomElement(['returned', 'borrowed', 'overdue']);

        $returnedAt = null;
        if ($status === 'returned') {
            $returnedAt = fake()->dateTimeBetween($borrowedAt, $dueDate);
        } elseif ($status === 'overdue') {
            $borrowedAt = fake()->dateTimeBetween('-2 months', '-1 month');
            $dueDate = Carbon::instance($borrowedAt)->addDays(14);
        }

        return [
            'book_id'     => Book::inRandomOrder()->first()->id ?? Book::factory(),
            'member_id'   => Member::inRandomOrder()->first()->id ?? Member::factory(),
            'borrowed_at' => $borrowedAt,
            'due_date'    => $dueDate,
            'returned_at' => $returnedAt,
            'status'      => fake()->randomElement(['returned', 'borrowed', 'overdue']),
            'notes'       => fake()->optional()->sentence(),
        ];
    }
}

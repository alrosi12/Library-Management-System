<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'            => fake()->name(),
            'email'           => fake()->unique()->safeEmail(),
            'phone'           => fake()->phoneNumber(),
            'membership_date' => fake()->date('Y-m-d', 'now'), // تاريخ انضمام لغاية اليوم
            'is_active'       => fake()->boolean(80), // 80% من الأعضاء سيكونون نشطين
        ];
    }
}

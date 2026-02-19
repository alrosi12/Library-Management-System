<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Category;
use App\Models\Member;
use App\Models\Publisher;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. الأساسيات
        $authors = Author::factory(10)->create();
        $publishers = Publisher::factory(5)->create();
        $categories = Category::factory(8)->create();
        $members = Member::factory(20)->create();

        // 2. الكتب والربط مع الأقسام
        $books = Book::factory(50)->create([
            'author_id' => fn() => $authors->random()->id,
            'publisher_id' => fn() => $publishers->random()->id,
        ])->each(function ($book) use ($categories) {
            $book->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        // 3. الاستعارات (التي شرحنا منطق تواريخها)
        Borrowing::factory(30)->create();

        // 4. المراجعات (المنطق المتعدد الأشكال)

        // إنشاء 20 مراجعة للكتب
        Review::factory(20)->create([
            'reviewable_id'   => fn() => $books->random()->id,
            'reviewable_type' => \App\Models\Book::class,
        ]);

        // إنشاء 20 مراجعة للمؤلفين
        Review::factory(20)->create([
            'reviewable_id'   => fn() => $authors->random()->id,
            'reviewable_type' => \App\Models\Author::class,
        ]);
    }
}

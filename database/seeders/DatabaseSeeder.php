<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Book::factory(33)
            ->create()
            ->each(function ($book) {
                $random_number = random_int(5, 30);
                Review::factory()->count($random_number)->good()->for($book)->create();
            });
        Book::factory(33)
            ->create()
            ->each(function ($book) {
                $random_number = random_int(5, 30);
                Review::factory()->count($random_number)->avarge()->for($book)->create();
            });
        Book::factory(34)
            ->create()
            ->each(function ($book) {
                $random_number = random_int(5, 30);
                Review::factory()->count($random_number)->bad()->for($book)->create();
            });
    }
}

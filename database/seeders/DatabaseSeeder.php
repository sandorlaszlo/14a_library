<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Reader;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Category::factory(10)->create();
        $books = Book::factory(50)->create();
        $authors = Author::factory(10)->create();
        $readers = Reader::factory(20)->create();

        foreach ($books as $book) {
            $book->authors()->attach(
                $authors->random(rand(1, 3))->pluck('id')
            );
        }

        foreach ($readers as $reader) {
            $reader->books()->attach(
                $books->random(rand(1, 5)),
                [
                    "start_date" => fake()->date(),
                    "end_date" => fake()->date(),
                    "is_returned" => fake()->boolean(),
                ]
            );
        }
    }
}

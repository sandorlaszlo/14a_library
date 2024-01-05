<?php

namespace Database\Factories;

use App\Models\Category;
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
        $categories = Category::all();

        return [
            'title' => $this->faker->sentence(),
            'pages' => $this->faker->numberBetween(100, 1000),
            'description' => $this->faker->paragraph(5),
            'ISBN' => $this->faker->unique()->isbn13(),
            'hard_cover' => $this->faker->boolean(),
            'category_id' => $this->faker->randomElement($categories)->id,
        ];
    }
}

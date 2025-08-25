<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'book_name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraphs(3, true),
            'author' => $this->faker->name(),
            'published_date' => $this->faker->date()
        ];
    }
}
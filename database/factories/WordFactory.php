<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WordFactory extends Factory
{
    public function definition(): array
    {
        $categories = ['animals', 'nature', 'objects', 'places', 'music', 'food', 'sport'];

        $word = fake()->word();

        return [
            'word'     => $word,
            'category' => fake()->randomElement($categories),
            'question' => 'What word am I? Hint: ' . fake()->sentence(6),
            'hint'     => fake()->sentence(4),
        ];
    }
}
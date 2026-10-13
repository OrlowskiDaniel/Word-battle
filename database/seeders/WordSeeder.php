<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Word;

class WordSeeder extends Seeder
{
    public function run(): void
    {
        $words = [
            [
                'word'     => 'elephant',
                'category' => 'animals',
                'question' => 'I am the largest land animal on Earth.',
                'hint'     => 'I have a trunk and tusks.',
            ],
            [
                'word'     => 'piano',
                'category' => 'music',
                'question' => 'I have 88 keys but no locks.',
                'hint'     => 'You press my keys with your fingers.',
            ],
            [
                'word'     => 'volcano',
                'category' => 'nature',
                'question' => 'I can erupt with lava and ash.',
                'hint'     => 'I am a mountain with a very hot temper.',
            ],
            [
                'word'     => 'umbrella',
                'category' => 'objects',
                'question' => 'I keep you dry when it rains.',
                'hint'     => 'You open and close me.',
            ],
            [
                'word'     => 'butterfly',
                'category' => 'animals',
                'question' => 'I start life as a caterpillar.',
                'hint'     => 'I have colourful wings.',
            ],
            [
                'word'     => 'compass',
                'category' => 'objects',
                'question' => 'I always point north.',
                'hint'     => 'Sailors and hikers use me.',
            ],
            [
                'word'     => 'pyramid',
                'category' => 'places',
                'question' => 'Ancient Egyptians built me as a tomb.',
                'hint'     => 'I have a square base and four triangular sides.',
            ],
            [
                'word'     => 'lightning',
                'category' => 'nature',
                'question' => 'I flash across the sky during a storm.',
                'hint'     => 'Thunder follows me.',
            ],
        ];

        foreach ($words as $word) {
            Word::create($word);
        }
    }
}
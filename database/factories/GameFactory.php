<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Word;

class GameFactory extends Factory
{
    public function definition(): array
    {
        return [
            'word_id' => Word::factory(),
            'status'  => fake()->randomElement(['waiting', 'active', 'finished']),
        ];
    }

    // convenience states - call Game::factory()->active()->create()
    public function waiting(): static
    {
        return $this->state(['status' => 'waiting']);
    }

    public function active(): static
    {
        return $this->state(['status' => 'active']);
    }

    public function finished(): static
    {
        return $this->state(['status' => 'finished']);
    }
}
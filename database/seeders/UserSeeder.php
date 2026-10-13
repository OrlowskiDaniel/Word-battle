<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // two test accounts
        User::create([
            'username' => 'player_one',
            'email'    => 'one@test.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'username' => 'player_two',
            'email'    => 'two@test.com',
            'password' => Hash::make('password'),
        ]);

        // extra random users for testing leaderboard
        User::factory(10)->create();
    }
}
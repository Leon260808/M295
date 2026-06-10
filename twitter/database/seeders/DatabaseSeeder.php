<?php

namespace Database\Seeders;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->count(20)
            ->has(Tweet::factory()->count(30))
            ->create();

        // E-Mail und Passwort des 1. Users anpassen
        User::first()->update([
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}

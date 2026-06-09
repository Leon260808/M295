<?php

namespace Database\Seeders;

use App\Models\Clown;
use Illuminate\Database\Seeder;

class KRestySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ein Mustereintrag aus der Aufgabenstellung
        Clown::create([
            'name'        => 'Kresty der Clown',
            'email'       => 'buero@kresty.ch',
            'description' => 'Zirkusclown und Pantomime',
            'rating'      => 3,
            'status'      => 'active',
        ]);

        // Datenbank per Knopfdruck mit 10 Testeinträgen befüllen
        Clown::factory(10)->create();
    }
}

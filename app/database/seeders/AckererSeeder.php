<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Plant;
use Illuminate\Database\Seeder;

class AckererSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Zwei Mustereinträge für plants
        $sonnenblume = Plant::create([
            'name'        => 'Sonnenblumen (Helianthus annuus)',
            'slug'        => 'sonnenblumen',
            'description' => 'Die Sonnenblume ist eine Pflanzenart aus der Familie der Korbblütler.',
            'stock'       => '10',
        ]);

        $kartoffel = Plant::create([
            'name'        => 'Kartoffel',
            'slug'        => 'kartoffel',
            'description' => 'Die Kartoffel ist eine Pflanzenart aus der Gattung der Nachtschattengewächse.',
            'stock'       => '20',
        ]);

        // Zwei Mustereinträge für areas (mit Relation zur Bepflanzung)
        Area::create([
            'plant_id'    => $sonnenblume->id,
            'name'        => 'Adligenswil Ost',
            'slug'        => 'adligenswil-ost',
            'description' => 'Fläche direkt am Eingang von Adligenswil-Dorf.',
            'address'     => 'Feldstrasse 1',
            'city'        => 'Adligenswil',
            'zip'         => '6043',
        ]);

        Area::create([
            'plant_id'    => $kartoffel->id,
            'name'        => 'Acker am Seeufer',
            'slug'        => 'acker-am-seeufer',
            'description' => 'Acker am linken Seeufer.',
            'address'     => 'Seestrasse 1',
            'city'        => 'Luzern',
            'zip'         => '6003',
        ]);

        // Zusätzliche Beispieldaten via Factories erzeugen:
        // drei Pflanzen mit je zwei Anbauflächen.
        Plant::factory(3)
            ->has(Area::factory()->count(2))
            ->create();
    }
}

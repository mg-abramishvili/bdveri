<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            StyleSeeder::class,
            SizeSeeder::class,
            ConstructSeeder::class,
            ManufacturerSeeder::class,
            SurfaceSeeder::class,
            TypeSeeder::class,
            ProductionSeeder::class,
        ]);
    }
}

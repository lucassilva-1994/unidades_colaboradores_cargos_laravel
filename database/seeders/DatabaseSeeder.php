<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CargosSeeder::class,
            UnidadesSeeder::class,
            ColaboradorSeeder::class,
            CargoColaboradorSeeder::class
        ]);
    }
}

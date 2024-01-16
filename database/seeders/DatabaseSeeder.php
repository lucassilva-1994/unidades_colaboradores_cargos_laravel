<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UnidadesSeeder::class,
            CargosSeeder::class,
            ColaboradorSeeder::class,
            CargoColaboradorSeeder::class
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(CargosSeeder::class);
        $this->call(UnidadesSeeder::class);
        $this->call(ColaboradorSeeder::class);
        $this->call(CargoColaboradorSeeder::class);
    }
}

<?php

namespace Database\Seeders;

use App\Models\CargoColaborador;
use App\Models\Colaborador;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CargoColaboradorSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $colaboradores = Colaborador::limit(10000)->get();
        foreach($colaboradores as $colaborador){
            CargoColaborador::create([
                'cargo_id' => $colaborador->cargo->id,
                'colaborador_id' => $colaborador->id,
                'nota_desempenho' => $faker->randomFloat(1,0.1,10)
           ]);
        }
    }
}

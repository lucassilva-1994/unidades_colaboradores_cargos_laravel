<?php

namespace Database\Seeders;

use App\Models\CargoColaborador;
use App\Models\Colaborador;
use Illuminate\Database\Seeder;

class CargoColaboradorSeeder extends Seeder
{
    public function run()
    {
        $colaboradores = Colaborador::inRandomOrder()->take(1000)->get();
        foreach($colaboradores as $colaborador){
            if(!CargoColaborador::whereColaboradorId($colaborador->id)->exists()){
                CargoColaborador::create([
                    'cargo_id' => $colaborador->cargo->id,
                    'colaborador_id' => $colaborador->id,
                    'nota_desempenho' => fake()->randomFloat(1,0.1,10)
               ]);
            }
        }
    }
}

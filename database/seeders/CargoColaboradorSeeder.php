<?php

namespace Database\Seeders;

use App\Models\CargoColaborador;
use App\Models\Colaborador;
use Illuminate\Database\Seeder;

class CargoColaboradorSeeder extends Seeder
{
    public function run()
    {
        $colaboradores = Colaborador::get();
        foreach($colaboradores as $colaborador){
            CargoColaborador::create([
                'cargo_id' => $colaborador->cargo->id,
                'colaborador_id' => $colaborador->id,
                'nota_desempenho' => random_int(0,10)
           ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Cargo;
use App\Models\Colaborador;
use App\Models\Unidade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Faker\Factory as Faker;
use Avlima\PhpCpfCnpjGenerator\Generator;

class ColaboradorSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('pt_BR');
        $unidades = Unidade::get();
        $cargos = Cargo::get();
        for($i=0;$i < 900;$i++){
            Colaborador::create([
                'unidade_id' => Arr::random($unidades->pluck('id')->toArray()),
                'cargo_id' => Arr::random($cargos->pluck('id')->toArray()),
                'nome' => $faker->name(),
                'cpf' => Generator::cpf(true),
                'email' => $faker->freeEmail(),
                'created_at' => $faker->dateTimeThisYear
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Unidade;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Avlima\PhpCpfCnpjGenerator\Generator;

class UnidadesSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create('pt_BR');
        for ($i = 0; $i < 150; $i++) {
            Unidade::create([
                'nome_fantasia' => $faker->unique()->company(),
                'razao_social' => $faker->unique()->company,
                'cnpj' => Generator::cnpj(true),
                'created_at' => $faker->dateTimeThisYear
            ]);
        }
    }
}
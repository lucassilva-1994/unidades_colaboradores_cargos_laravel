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
            $name = $faker->name();
            Colaborador::create([
                'unidade_id' => Arr::random($unidades->pluck('id')->toArray()),
                'cargo_id' => Arr::random($cargos->pluck('id')->toArray()),
                'nome' => $name,
                'cpf' => Generator::cpf(true),
                'email' => self::removeAccents($name),
                'created_at' => $faker->dateTimeThisYear
            ]);
        }
    }

    private static function removeAccents($name){
        $emails = [ 
            '@gmail.com','@outlook.com','@hotmail.com','@live.com','@msn.com','@yahoo.com',
            '@mail.com','@terra.com.br','@uol.com.br','@ig.com.br','@r7.com'
        ];
        $name = iconv('UTF-8', 'ASCII//TRANSLIT', $name);
        $name = preg_replace('/[^a-zA-Z0-9]/', '', strtolower(str_replace([' ','Dr.','Sr.','Srta.','Sra.'], '', $name)));
        return $name.Arr::random($emails);
    }
}

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
        $unidades = Unidade::get();
        $cargos = Cargo::get();
        for($i=0;$i < 20000;$i++){
            $name = fake()->unique()->name();
            $cpfUnique = Generator::cpf(true);
            $emailUnique = self::generateEmail($name);
            $cpf = Colaborador::whereCpf($cpfUnique)->exists();
            $email = Colaborador::whereEmail($emailUnique)->exists();
            if(!$cpf && !$email){
                Colaborador::create([
                    'unidade_id' => Arr::random($unidades->pluck('id')->toArray()),
                    'cargo_id' => Arr::random($cargos->pluck('id')->toArray()),
                    'nome' => $name,
                    'cpf' =>  $cpfUnique,
                    'email' => $emailUnique,
                    'created_at' => fake()->dateTime()
                ]);
            }
        }
    }

    private static function generateEmail($name)
    {
        $name = iconv('UTF-8', 'ASCII//TRANSLIT', $name);
        $name =  preg_replace('/[^a-zA-Z0-9]/', '', strtolower(str_replace([' ', 'Dr.', 'Sr.', 'Srta.', 'Sra.'], '', $name)));
        return $name . '@' . Arr::random([fake()->freeEmailDomain()]);
    }
}

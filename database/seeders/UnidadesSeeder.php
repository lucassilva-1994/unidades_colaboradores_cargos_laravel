<?php

namespace Database\Seeders;

use App\Models\HelperModel;
use App\Models\Unidade;
use Illuminate\Database\Seeder;
use Avlima\PhpCpfCnpjGenerator\Generator;

class UnidadesSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 150; $i++) {
            $cnpj = Generator::cnpj(true);
            $unidadeCnpj = Unidade::whereCnpj($cnpj)->exists();
            if(!$unidadeCnpj){
                HelperModel::setData([
                    'nome_fantasia' => self::mudarNome(fake()->unique()->company()),
                    'razao_social' => self::mudarNome(fake()->unique()->company()),
                    'cnpj' => $cnpj,
                    'created_at' => fake()->dateTimeThisYear
                ],Unidade::class);
            }
        }
    }

    public static function mudarNome($nome){
        return str_replace(['-','.'],' ',$nome);
    }
}

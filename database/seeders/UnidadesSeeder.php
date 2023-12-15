<?php

namespace Database\Seeders;

use App\Helpers\Model;
use App\Models\Unidade;
use Illuminate\Database\Seeder;
use Avlima\PhpCpfCnpjGenerator\Generator;

class UnidadesSeeder extends Seeder
{
    use Model;
    public function run()
    {
        for ($i = 0; $i < 150; $i++) {
            $cnpj = Generator::cnpj(true);
            $unidadeCnpj = Unidade::whereCnpj($cnpj)->exists();
            if(!$unidadeCnpj){
                self::setData([
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

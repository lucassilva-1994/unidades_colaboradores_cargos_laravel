<?php
namespace Database\Seeders;

use App\Helpers\Model;
use App\Models\Cargo;
use App\Models\Colaborador;
use App\Models\Unidade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Avlima\PhpCpfCnpjGenerator\Generator;

class ColaboradorSeeder extends Seeder
{
    use Model;
    public function run()
    {
        $unidades = Unidade::get();
        $cargos = Cargo::get();
        for($i=0;$i < 10000;$i++){
            $name = fake()->name();
            $cpf = Generator::cpf(true);
            $email = self::generateEmail($name);
            $verify = Colaborador::whereCpfOrEmail($cpf,$email)->exists();
            if(!$verify){
                self::setData([
                    'unidade_id' => Arr::random($unidades->pluck('id')->toArray()),
                    'cargo_id' => Arr::random($cargos->pluck('id')->toArray()),
                    'nome' => $name,
                    'cpf' =>  $cpf,
                    'email' => $email,
                    'created_at' => fake()->dateTime()
                ],Colaborador::class);
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

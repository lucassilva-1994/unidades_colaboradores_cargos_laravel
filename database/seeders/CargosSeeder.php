<?php

namespace Database\Seeders;

use App\Helpers\Model;
use App\Models\{Cargo,Unidade};
use Illuminate\Database\Seeder;

class CargosSeeder extends Seeder
{
    use Model;
    public function run()
    {
        $unidades = Unidade::get('id');
        foreach ($unidades as $unidade) {
            foreach (self::cargos() as $cargo) {
                self::setData([
                    'cargo' => $cargo,
                    'unidade_id' => $unidade->id
                ], Cargo::class);
            }
        }
    }

    private static function cargos()
    {
        return  [
            "Médico",
            "Enfermeiro",
            "Professor",
            "Engenheiro Civil",
            "Advogado",
            "Programador de Computadores",
            "Analista de Sistemas",
            "Contador",
            "Administrador de Empresas",
            "Farmacêutico",
            "Psicólogo",
            "Jornalista",
            "Publicitário",
            "Analista Financeiro",
            "Arquiteto",
            "Dentista",
            "Nutricionista",
            "Veterinário",
            "Designer Gráfico",
            "Fisioterapeuta",
            "Consultor de Recursos Humanos",
            "Gerente de Projetos",
            "Analista de Marketing",
            "Analista de Qualidade",
            "Analista de Logística",
            "Corretor de Imóveis",
            "Técnico em Informática",
            "Eletricista",
            "Técnico em Enfermagem",
            "Técnico em Segurança do Trabalho"
        ];
    }
}

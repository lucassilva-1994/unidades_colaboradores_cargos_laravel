<?php

namespace Database\Seeders;

use App\Models\Cargo;
use App\Models\HelperModel;
use Illuminate\Database\Seeder;

class CargosSeeder extends Seeder
{

    public function run()
    {
        foreach(self::cargos() as $cargo){
            HelperModel::setData([
                'cargo' => $cargo
            ],Cargo::class);
        }
    }

    private static function cargos(){
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

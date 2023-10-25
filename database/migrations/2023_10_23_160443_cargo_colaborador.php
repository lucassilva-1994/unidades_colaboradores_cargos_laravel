<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CargoColaborador extends Migration
{
    private $table = 'cargo_colaborador';
    public function up()
    {
        Schema::create($this->table, function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cargo_id');
            $table->unsignedBigInteger('colaborador_id');
            $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete('cascade');
            $table->foreign('colaborador_id')->references('id')->on('colaboradores')->onDelete('cascade');
            $table->decimal('nota_desempenho',3,1);
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}

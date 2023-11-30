<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Colaboradores extends Migration
{
    private $table = 'colaboradores';
    public function up()
    {
        Schema::create($this->table, function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('unidade_id');
            $table->unsignedBigInteger('cargo_id');
            $table->string('nome',100);
            $table->string('cpf',14)->unique();
            $table->string('email',100)->unique();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->foreign('unidade_id')->references('id')->on('unidades')->onDelete('cascade');
            $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists();
    }
}

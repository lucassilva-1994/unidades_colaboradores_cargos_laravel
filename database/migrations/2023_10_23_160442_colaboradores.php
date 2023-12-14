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
            $table->uuid('id')->primary();
            $table->bigInteger('order');
            $table->string('nome',100);
            $table->string('cpf',14)->unique();
            $table->string('email',100)->unique();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->foreignUuid('unidade_id')->references('id')->on('unidades')->onDelete('cascade');
            $table->foreignUuid('cargo_id')->references('id')->on('cargos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists();
    }
}

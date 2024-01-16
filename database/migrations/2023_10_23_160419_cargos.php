<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cargos extends Migration
{
    private $table = 'cargos';
    public function up()
    {
        Schema::create($this->table, function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->bigInteger('order');
            $table->string('cargo',100);
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->foreignUuid('unidade_id')->references('id')->on('unidades')->cascadeOnDelete();
        });
    }
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}

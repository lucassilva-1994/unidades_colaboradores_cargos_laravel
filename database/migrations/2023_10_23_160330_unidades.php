<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Unidades extends Migration
{
    private $table = 'unidades';

    public function up()
    {
        Schema::create($this->table, function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->bigInteger('order');
            $table->string('nome_fantasia',100)->unique();
            $table->string('razao_social',100)->unique();
            $table->string('cnpj',18)->unique();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}

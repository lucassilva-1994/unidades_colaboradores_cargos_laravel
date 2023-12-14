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
            $table->string('cargo');
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
        });
    }
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}

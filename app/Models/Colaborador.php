<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    protected $table = 'colaboradores';
    protected $fillable = ['id','order','unidade_id','cargo_id','nome','cpf','email','created_at','updated_at'];
    public $timestamps = false;
    protected $keyType = 'string';

    public function unidade(){
        return $this->belongsTo(Unidade::class,'unidade_id','id');
    }

    public function cargo(){
        return $this->belongsTo(Cargo::class,'cargo_id','id');
    }

    public function cargos(){
        return $this->belongsToMany(Cargo::class,'cargo_colaborador','colaborador_id','cargo_id');
    }

    public function desempenho(){
        return $this->hasOne(CargoColaborador::class,'colaborador_id','id');
    }
}

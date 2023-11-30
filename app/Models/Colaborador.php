<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    protected $table = 'colaboradores';
    protected $fillable = ['id','unidade_id','cargo_id','nome','cpf','email','created_at','updated_at'];
    protected $with = ['unidade','cargo','cargos'];
    public $timestamps = false;
    public static function createOrUpdate(array $data){
        if(!isset($data['id'])){
            HelperModel::setData($data, Colaborador::class);
            return true;
        }
        HelperModel::updatedata( $data, Colaborador::class,['id' => $data['id']]);
        return true;
    }

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

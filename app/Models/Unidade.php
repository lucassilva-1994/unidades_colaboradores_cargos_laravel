<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    protected $table = 'unidades';
    protected $fillable = [ 'id','order','nome_fantasia','razao_social', 'cnpj','created_at','updated_at'];
    public $timestamps = false;
    protected $keyType = 'string';
    
    public function colaboradores(){
        return $this->hasMany(Colaborador::class,'unidade_id','id');
    }
}

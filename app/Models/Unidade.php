<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    protected $table = 'unidades';
    protected $fillable = [ 'id','nome_fantasia','razao_social', 'cnpj','created_at','updated_at'];
    public $timestamps = false;

    public static function createOrUpdate(array $data){
        if(!isset($data['id'])){
            HelperModel::setData($data,Unidade::class);
            return true;
        }   
       HelperModel::updatedata($data,Unidade::class,['id' => $data['id']]);
       return true;
    }

    public function colaboradores(){
        return $this->hasMany(Colaborador::class,'unidade_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = 'cargos';
    protected $fillable = ['cargo','created_at','updated_at'];
    public $timestamps = false;

    public function getCreatedAtAttribute(){
        return date("d/m/Y H:i:s", strtotime($this->attributes['created_at']));
    }
    
    public function getUpdatedAtAttribute(){
        return date("d/m/Y H:i:s", strtotime($this->attributes['updated_at']));
    }

    public static function createOrUpdate(array $data){
        if(!isset($data['id'])){
            HelperModel::setData($data,Cargo::class);
            return true;
        }
        HelperModel::updatedata(
            ['cargo' => $data['cargo']],
            Cargo::class,
            ['id' => $data['id']]
        );
        return true;
    }

    public function colaboradores(){
        return $this->hasMany(Colaborador::class);
    }
}

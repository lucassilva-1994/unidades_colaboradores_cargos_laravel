<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CargoColaborador extends Model
{
    protected $table = 'cargo_colaborador';
    protected $fillable = ['id','cargo_id','colaborador_id','nota_desempenho'];
    protected $with = ['cargos','colaboradores'];
    public $timestamps = false;

    public function getNotaDesempenhoAttribute(){
        return number_format($this->attributes['nota_desempenho'],1);
    }

    public function cargos(){
        return $this->belongsTo(Cargo::class,'cargo_id','id');
    }

    public function colaboradores(){
        return $this->belongsTo(Colaborador::class, 'colaborador_id','id');
    }
}

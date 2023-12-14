<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CargoColaborador extends Model
{
    protected $table = 'cargo_colaborador';
    protected $fillable = ['id','cargo_id','colaborador_id','nota_desempenho'];
    public $timestamps = false;

    public function getNotaDesempenhoAttribute(){
        return number_format($this->attributes['nota_desempenho'],1);
    }

    public function colaborador(){
        return $this->belongsTo(Colaborador::class);
    }
}

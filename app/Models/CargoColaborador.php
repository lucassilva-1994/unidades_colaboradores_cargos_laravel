<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CargoColaborador extends Pivot
{
    protected $table = 'cargo_colaborador';
    protected $fillable = ['cargo_id','colaborador_id','nota_desempenho'];
    public $timestamps = false;

    public function getNotaDesempenhoAttribute(){
        return number_format($this->attributes['nota_desempenho'],1);
    }

    public function colaborador():BelongsTo{
        return $this->belongsTo(Colaborador::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    public static function search(string $search, int $perPage = 20){
        return self::with('colaborador.cargo','colaborador.unidade')
        ->whereHas('colaborador',function(Builder $builder) use ($search){
            $builder->where('nome','like',"%$search%");
        })
        ->orWhereHas('colaborador.cargo',function(Builder $builder) use($search){
            $builder->where('cargo','like',"%$search%");
        })
        ->orWhereHas('colaborador.unidade',function(Builder $builder) use($search){
            $builder->where('nome_fantasia','like',"%$search%");
        })
        ->orderByDesc('nota_desempenho')
        ->paginate($perPage);
    }
}

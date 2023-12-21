<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Colaborador extends Model
{
    protected $table = 'colaboradores';
    protected $fillable = ['id','order','unidade_id','cargo_id','nome','cpf','email','created_at','updated_at'];
    public $timestamps = false;
    protected $keyType = 'string';

    public function unidade():BelongsTo{
        return $this->belongsTo(Unidade::class);
    }

    public function cargo():BelongsTo{
        return $this->belongsTo(Cargo::class);
    }

    public static function search(string $search,int $perpage = 20){
        return self::with('desempenho','cargo','unidade')
        ->where('nome','like',"%$search%")
        ->orWhere('email','like',"%$search%")
        ->orWhereHas('cargo',function(Builder $builder) use ($search){
            $builder->where('cargo','like',"%$search%");
        })
        ->orWhereHas('unidade',function(Builder $builder) use ($search){
            $builder->where('nome_fantasia','like',"%$search%");
        })
        ->orderByDesc('order')
        ->paginate($perpage);
    }

    public function desempenho():HasOne{
        return $this->hasOne(CargoColaborador::class);
    }
}

<?php

namespace App\Models;

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

    public function desempenho():HasOne{
        return $this->hasOne(CargoColaborador::class);
    }
}

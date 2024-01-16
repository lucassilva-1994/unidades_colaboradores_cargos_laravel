<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo,HasMany};

class Cargo extends Model
{
    protected $table = 'cargos';
    protected $fillable = ['id','order','cargo','created_at','updated_at','unidade_id'];
    public $timestamps = false;
    protected $keyType = 'string';

    public function getCreatedAtAttribute(){
        return date("d/m/Y H:i:s", strtotime($this->attributes['created_at']));
    }
    
    public function getUpdatedAtAttribute(){
        return date("d/m/Y H:i:s", strtotime($this->attributes['updated_at']));
    }

    public function unidade():BelongsTo{
        return $this->belongsTo(Unidade::class);
    }

    public function colaboradores():HasMany{
        return $this->hasMany(Colaborador::class);
    }
}

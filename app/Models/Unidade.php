<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unidade extends Model
{
    protected $table = 'unidades';
    protected $fillable = [ 'id','order','nome_fantasia','razao_social', 'cnpj','created_at','updated_at'];
    public $timestamps = false;
    protected $keyType = 'string';
    
    public function colaboradores():HasMany{
        return $this->hasMany(Colaborador::class);
    }

    public static function search(string $search, int $perPage = 20){
        return self::with('colaboradores')
        ->where('nome_fantasia','like',"%$search%")
        ->orWhere('razao_social','like',"%$search%")
        ->orWhere('cnpj','like',"%$search%")
        ->withCount('colaboradores')
        ->orderByDesc('colaboradores_count','DESC')
        ->paginate($perPage);
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnidadeRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(): array{
        return [
           'nome_fantasia' => 'required|unique:unidades,nome_fantasia',
           'razao_social' => 'required|unique:unidades,razao_social',
           'cnpj' => 'required|max:18|unique:unidades,cnpj'
        ];
    }
}

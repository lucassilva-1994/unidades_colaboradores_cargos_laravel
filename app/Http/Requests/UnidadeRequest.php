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
           'nome_fantasia' => 'required',
           'razao_social' => 'required',
           'cnpj' => 'required|max:18'
        ];
    }
}

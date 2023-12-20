<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UnidadeRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(): array{
        return [
           'nome_fantasia' => ['required','max:100',Rule::unique('unidades')->ignore($this->id)],
           'razao_social' => ['required','max:100',Rule::unique('unidades')->ignore($this->id)],
           'cnpj' => ['required','max:18',Rule::unique('unidades')->ignore($this->id)]
        ];
    }
}

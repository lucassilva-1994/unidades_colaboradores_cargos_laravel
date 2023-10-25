<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColaboradorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules(): array{
        return [
            'nome' => 'required| max:100',
            'cpf' => 'required| between:14,15',
            'email' => 'required| email| max: 100'
        ];
    }

    public function messages(): array{
        return [
            'nome.required' => 'Nome obrigatório.',
            'nome.max' => 'O nome pode ter no máximo :max caracteres.',
            'cpf.required' => 'CPF obrigatório.',
            'cpf.between' => 'CPF inválido.',
            'email.required' => 'Email obrigatório.',
            'email.email' => 'Email inválido.',
            'email.max' => 'Email pode ter no máximo :max carcteres.'
        ];
    }
}

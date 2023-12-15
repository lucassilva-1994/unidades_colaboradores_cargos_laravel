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
}

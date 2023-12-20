<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ColaboradorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules(): array{
        return [
            'nome' => ['required','max:100'],
            'cpf' => ['required', 'between:14,15', Rule::unique('colaboradores')->ignore($this->id)],
            'email' => ['required', 'email', 'max: 100', Rule::unique('colaboradores')->ignore($this->id)]
        ];
    }
}

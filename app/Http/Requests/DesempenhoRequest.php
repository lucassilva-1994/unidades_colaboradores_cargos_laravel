<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DesempenhoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules():array{
        return [
            'nota_desempenho' => 'required|numeric|between:0,10'
        ];
    }

    public function messages(): array{
        return [
            'nota_desempenho.required' => 'Avaliação é obrigatório.',
            'nota_desempenho.numeric'  => 'Nota inválida.',
            'nota_desempenho.between'  => 'A nota desempenho deve ser entre 0 e 10.',
        ];
    }
}

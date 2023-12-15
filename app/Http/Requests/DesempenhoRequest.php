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
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaixaEntrega extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'data_entrega' => 'required'
        ];
    }

    public function messages(){
        return [
            'data_entrega.required' => 'Digite uma data válida para a Data de Entrega',
        ];
    }

}

<?php

namespace App\Http\Requests\Somos;

use Illuminate\Foundation\Http\FormRequest;

class SomosItemRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'item'      => ['required', 'max:300'],
        ];
    }

    public function messages()
    {   
        return [
            'item.required'     =>  'Debes ingresar descripción del objetivo.',
            'item.max'          =>  'Descripción del objetivo solo puede contener un máximo de 300 carácteres.',
        ];
        
    }
}

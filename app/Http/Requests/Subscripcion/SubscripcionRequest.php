<?php

namespace App\Http\Requests\Subscripcion;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubscripcionRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
           'nombre' => ['required', 'max:50'],
           'correo' => ['required', ($this->method() == 'PUT') ? Rule::unique('suscripciones')->ignore($this->id, 'id') : 'unique:suscripciones'],
        ];
    }

    public function messages()
    {
        return [
            'nombre.required'       =>  'Debes ingresar un nombre. ',
            'nombre.max'            =>  'Nombre admite un maximo de 50 caracteres. ',
            'correo.unique'         =>  'Correo ya esta ingresado en los suscriptores. ',
            'correo.required'       =>  'Debes ingresar un correo. ',          
        ];
    }
}

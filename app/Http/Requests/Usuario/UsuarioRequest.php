<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsuarioRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'      => ['sometimes', 'required', 'max:80'],
            'email'     => ['sometimes', 'required', ($this->method() == 'PUT') ? 'unique:users,email,'.$this->id.'' : 'unique:users'], 
            'password'  => ['sometimes','required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Nombre de usuario es obligatorio. ',
            'name.max'          => 'Nombre admite un maximo de 80 caracteres. ',
            'email.required'    => 'Correo electronico es oblogatorio. ',
            'email.unique'      => 'Correo electronico ya ha sido ingresado. ',
            'password.required' => 'Contraseña es obligatorio',
        ];
    }
}

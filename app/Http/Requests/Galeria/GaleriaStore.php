<?php

namespace App\Http\Requests\Galeria;

use Illuminate\Foundation\Http\FormRequest;

class GaleriaStore extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre'      => [($this->method() == 'POST') ? 'required' : 'sometimes',($this->method() == 'PUT') ? 'required' : 'sometimes', 'max:20', ($this->method() == 'PUT') ? 'unique:galerias,nombre,'.$this->id.'' : 'unique:galerias'],
            'imagen'      => [($this->method() == 'POST') ? 'required' : 'sometimes'],
            'imagen.*'    => ['image','mimes:jpeg,bmp,png','max:1000'],
        ];
    }

    public function messages()
    {
        return [
            'nombre.required'       =>  'Debe ingresar un nombre para la galeria',
            'nombre.max'            =>  'El nombre puede tener maximo 20 caracteres',
            'nombre.unique'         =>  'El nombre ingresado ya existe, intente con otro nombre',
            'imagen.required'       =>  'Debes seleccionar al menos una imagen.',
            'imagen.*.image'        =>  'Solo se admiten solo imagenes. ',
            'imagen.*.mimes'        =>  'Formatos perimitidos (JPEG, BMP, PNG).',
            'imagen.*.max'          =>  'Las imagenes deben pesar maximo 1MB.',
        ];
    }
}

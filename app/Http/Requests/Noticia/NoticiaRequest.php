<?php

namespace App\Http\Requests\Noticia;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NoticiaRequest extends FormRequest
{

    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'titulo'        =>  ['required', 'max:35', ($this->method() == 'PUT') ? Rule::unique('convenios')->ignore($this->id, 'id') : 'unique:convenios'],
            'estado'        =>  ['required'],
            'imagen'        =>  [($this->method() == 'POST') ? 'required' : 'sometimes', 'image', 'mimes:jpeg,bmp,png', 'max:1000'],
            'descripcion'   =>  ['required', 'max:65000', 'min:30'],
        ];
    }

    public function messages()
    {
        return [
            'titulo.required'       =>  'Titulo es obligatorio. ',
            'titulo.max'            =>  'Titulo admite un maximo de 35 caracteres. ',
            'titulo.unique'         =>  'Titulo ya esta ingresado en los convenios. ',
            'estado.required'       =>  'Estado es obligatorio. ',
            'imagen.required'       =>  'Debes seleccionar una imagen. ',
            'imagen.image'          =>  'Solo de permiten imagenes. ',
            'imagen.mimes'          =>  'Formatos perimitidos (JPEG, BMP, PNG). ',
            'imagen.max'            =>  'Las imagenes deben pesar maximo 1MB. ',
            'descripcion.required'  =>  'Ingrese una descripción. ',
            'descripcion.max'       =>  'Descripción admite un maximo de 65.000 caracteres. ',
            'descripcion.min'       =>  'Descripción debe contener al menos 30 caracteres. ',
        ];
    }
}

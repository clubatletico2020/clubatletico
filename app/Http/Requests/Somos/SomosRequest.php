<?php

namespace App\Http\Requests\Somos;

use Illuminate\Foundation\Http\FormRequest;

class SomosRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'imagen'        => ['max:1000','image', 'mimes:jpeg,bmp,png'],
            'mision'        => ['max:700'],
            'vision'        => ['max:700'],
            'tipo_archivo'  => [($this->method() == 'PUT') ? 'required' : 'sometimes'],
            'documento'     => ['required_if:tipo_archivo,==,1', 'max:1000', 'mimes:pdf'],
            'imagen'        => ['required_if:tipo_archivo,==,2','image', 'max:1000', 'mimes:jpeg,bmp,png'],
        ];
    }

    public function messages()
    {
        return [
            'imagen.image'             =>  'Solo se admiten imagenes.',
            'imagen.mimes'             =>  'Formato de imagen incorrecto. "JPEG, BMP, PNG son formatos validos.',
            'imagen.max'               =>  'Imagen excede peso "1MB maximo".',
            'mision.max'               =>  'Misión solo se acepta un maximo de 700 caracteres',
            'vision.max'               =>  'Visión solo se acepta un maximo de 700 caracteres',
            'tipo_archivo.required'    => 'Debes seleccionar un tipo de archivo',
            'documento.required_if'    => 'Seleccionar un documento. ',
            'documento.mimes'          =>  'Formato perimitido (PDF).',
            'documento.max'            =>  'El documento debe pesar maximo 1MB.',
            'imagen.required_if'       => 'Seleccionar una imagen. ',
            'imagen.image'             =>  'Solo se admiten solo imagenes. ',
            'imagen.mimes'             =>  'Formatos perimitidos (JPEG, BMP, PNG).',
            'imagen.max'               =>  'Las imagenes deben pesar maximo 1MB.',
        ];
    }
}

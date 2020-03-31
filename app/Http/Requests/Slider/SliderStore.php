<?php

namespace App\Http\Requests\Slider;

use Illuminate\Foundation\Http\FormRequest;

class SliderStore extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'imagen' => [($this->method() == 'POST') ? 'required' : 'sometimes','image','mimes:jpeg,bmp,png','max:1100', 'dimensions:max_height=450', 'dimensions:min_height=450'],
            'estado' => ['required'],
        ]; 
    }

    public function messages()
    {
        return [
            'imagen.sometimes'         =>  'Sometimes',
            'imagen.required'          =>  'Debes seleccionar una imagen.',
            'imagen.image'             =>  'Solo se admiten imagenes.',
            'imagen.mimes'             =>  'Formato de imagen incorrecto. "JPEG, BMP, PNG son formatos validos.',
            'imagen.max'               =>  'Imagen excede peso "1MB maximo".',
            'imagen.dimensions'        =>  'El alto de la imagen debe ser de 450px',
            'estado.required'          =>  'Campo estado es requerido',      

        ];
    }
}

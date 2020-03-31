<?php

namespace App\Http\Requests\RedesSociales;

use Illuminate\Foundation\Http\FormRequest;

class RedesSocialesRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'facebook'   =>  ['regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/', 'nullable'],
            'instagram'  =>  ['regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/', 'nullable'],
            'twitter'    =>  ['regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/', 'nullable'],
            'youtube'    =>  ['regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/', 'nullable'],
        ];
    }

    public function messages()
    {   
        return
        [
            'facebook.regex'    =>  "Formato url de facebook es incorrecto. ",
            'instagram.regex'   =>  "Formato url de instagram es incorrecto. ",
            'twitter.regex'     =>  "Formato url de twitter es incorrecto. ",
            'youtube.regex'     =>  "Formato url de youtube es incorrecto. ",
        ];
    }
}

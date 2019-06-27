<?php

namespace App\Http\Requests;
use Session;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user.name'         => ['required', 'string', 'max:255', 'regex:|^[\pL\s]+$|u'],
            'phones.*.number'   => ['required', 'regex:^\([1-9]{2}\) (?:[2-8]|9[1-9])[0-9]{3}\-[0-9]{4}$^']
        ];
    }

    public function messages()
    {
        return [
            'required'                => 'Este campo é obrigatório!',
            'max'                     => 'Este campo deve possuir no máximo :max caracteres!',
            'user.name.regex'         => 'Este campo deve possuir apenas letras!',
            'phones.*.number.regex'   => 'Número de telefone inválido!'
        ];
    }

    public function attributes()
    {
        return [
            'user.name'         => 'nome',
            'phones.*.number'   => 'número de telefone'
        ];
    }

    public function withValidator($validator)
    {
        if ($validator->fails()) {
            Session::flash('warning', 'Foram encontrados erros no formulário!');
        } 
    }
}

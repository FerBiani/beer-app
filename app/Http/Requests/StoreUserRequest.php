<?php

namespace App\Http\Requests;
use Session;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user.name'         => ['required', 'string', 'max:255', 'regex:|^[\pL\s]+$|u'],
            'user.email'        => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'user.password'     => ['required', 'string', 'min:8', 'confirmed'],
            'phones.*.number'   => ['required', 'regex:^\([1-9]{2}\) (?:[2-8]|9[1-9])[0-9]{3}\-[0-9]{4}$^']
        ];
    }

    public function messages()
    {
        return [
            'required'                => 'Este campo é obrigatório!',
            'email'                   => 'Informe um e-mail válido!',
            'max'                     => 'Este campo deve possuir no máximo :max caracteres!',
            'min'                     => 'Este campo deve possuir no mínimo :min caracteres!',
            'user.name.regex'         => 'Este campo deve possuir apenas letras!',
            'user.email.unique'       => 'Este e-mail já está sendo utilizado!',
            'user.password.min'       => 'A senha deve possuir no mínimo 8 caracteres!',
            'user.password.confirmed' => 'As senhas não conferem!',
            'phones.*.number.regex'   => 'Número de telefone inválido!'
        ];
    }

    public function attributes()
    {
        return [
            'user.name'         => 'nome',
            'user.email'        => 'e-mail',
            'user.password'     => 'senha',
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

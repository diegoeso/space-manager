<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre'    => 'required|string',
            'apellidoP' => 'required|string',
            'apellidoM' => 'required|string',
            'nickname'  => 'required|unique:usuarios,nickname',
            'email'     => 'required|email|unique:usuarios,email|regex:/(.*)uaemex\.mx/i',
            'telefono'  => 'numeric|digits:10',
            'password'  => 'required|confirmed',
            'foto'      => 'image',
            'matricula' => 'numeric',
        ];

    }
}

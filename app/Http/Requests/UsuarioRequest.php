<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre'    => 'required|string',
            'apellidoP' => 'required|string',
            'apellidoM' => 'required|string',
            'nickname'  => 'required|unique:usuarios,nickname',
            'email'     => 'required|email|unique:usuarios,email',
            'telefono'  => 'numeric|digits:10',
            'password'  => 'required|confirmed',
            'foto'      => 'image',
            'matricula' => 'numeric',
        ];

    }
}

<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class PerfilUsuarioRequest extends FormRequest
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
            'email'     => 'required|email|unique:usuarios,email,' . Auth::user()->id,
            'telefono'  => 'numeric|digits:10',
            'password'  => 'confirmed',
            'foto'      => 'image',
            'matricula' => 'numeric',
            // 'carrera'   => 'required_if:' . Auth::user()->tipoCuenta . ',3',

        ];
    }
}

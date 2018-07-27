<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'nickname'  => 'required|unique:users,nickname',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|confirmed',
            'telefono'  => 'required|numeric|min:10',
            // 'foto'      => 'image|dimensions:min_width=256,min_height=256',
            'roles'     => 'required',
        ];
    }
}

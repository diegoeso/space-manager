<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'apellidoP' => 'required|string|alpha',
            'apellidoM' => 'required|string|alpha',
            'nickname'  => 'required',
            'telefono'  => 'numeric|digits:10',
            'email'     => 'required|email',
            'password'  => 'confirmed',
            'foto'      => 'image',

        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolicitudRequest extends FormRequest
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
            // 'fechaInicio'         => 'required',
            // 'fechaFin'            => 'required',
            'horaInicio'          => 'required',
            'horaFin'             => 'required',
            'actividadAcademica'  => 'required',
            'asistentesEstimados' => 'required',
            'tipoUsuario'         => 'required',
            'usuarioSolicitud'    => 'required',
            'area_id'             => 'required',
            'espacio_id'          => 'required',

        ];
    }
}

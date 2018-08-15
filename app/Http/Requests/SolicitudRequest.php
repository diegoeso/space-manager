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
            'fechaInicio'         => 'required|date',
            'fechaFin'            => 'required|date',
            'horaInicio'          => 'required',
            'horaFin'             => 'required',
            'actividadAcademica'  => 'required',
            'asistentesEstimados' => 'required|numeric',
            'area_id'             => 'required',
            'espacio_id'          => 'required',
        ];
    }
}

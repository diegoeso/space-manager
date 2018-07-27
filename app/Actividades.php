<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividades extends Model
{

    protected $fillable = [
        'fecha',
        'horaInicio',
        'horaFin',
        'actividadAcademica',
        'estado',
        'docente',
        'grupo',
        'semestre',
        'carrera',
        'tipoRegistro',
        'area_id',
        'espacio_id',
    ];
}

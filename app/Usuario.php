<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Date\Date;

class Usuario extends Authenticatable
{
    /**
     * Tipo de usuarios
     * 2 - Profesores
     * 3 - Alumnos
     */
    use Notifiable;

    protected $fillable = [
        'nombre',
        'apellidoP',
        'apellidoM',
        'nickname',
        'email',
        'password',
        'telefono',
        'tipoCuenta',
        'carrera',
        'semestre',
        'matricula',
        'foto',
        'nombreCompleto',
        'confirmacion',
        'codigoConfirmacion',
        'envioEmail',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFullNameAttribute()
    {
        return $this->nombre . ' ' . $this->apellidoP . ' ' . $this->apellidoM;
    }

    public function solicitud()
    {
        return $this->hasMany(Solicitudes::class, 'usuarioSolicitud');
    }

    public function getCreatedAtAttribute($date)
    {
        return new Date($date);
    }

    public function nombreCarrera($carrera)
    {
        switch ($carrera) {
            case 1:
                return 'Ing. En Software';
                break;
            case 2:
                return 'Lic. En Seguridad Ciudadana';
                break;
            case 3:
                return 'Ing. En Producción Industrial';
                break;
            case 4:
                return 'Ing. En Plasticos';
                break;
            default:
                return 'Sin Carrera';
                break;
        }
    }

    public function nombreSemestre($semestre)
    {
        switch ($semestre) {
            case 1:
                return '1º Semestre';
                break;
            case 2:
                return '2º Semestre';
                break;
            case 3:
                return '3º Semestre';
                break;
            case 4:
                return '4º Semestre';
                break;
            case 5:
                return '5º Semestre';
                break;
            case 6:
                return '6º Semestre';
                break;
            case 7:
                return '7º Semestre';
                break;
            case 8:
                return '8º Semestre';
                break;
            case 9:
                return '9º Semestre';
                break;
            case 10:
                return '10º Semestre';
                break;
            case 11:
                return 'Catedrático';
                break;
            case 12:
                return 'Maestría';
                break;
            case 13:
                return 'Doctorado';
                break;
            default:
                return 'NAN';
                break;
        }
    }

    public function tipoCuenta($tipoCuenta)
    {
        switch ($tipoCuenta) {
            case 0:
                return 'Administrador';
                break;
            case 1:
                return 'Responsable de Área';
                break;
            case 2:
                return 'Profesor';
                break;
            case 3:
                return 'Alumno';
                break;
            default:
                return 'Usuario';
                break;
        }
    }
}

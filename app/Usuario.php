<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
}

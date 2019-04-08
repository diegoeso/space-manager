<?php

namespace App;

use App\User;
use App\Usuario;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Solicitud extends Model
{
    protected $table = 'solicitudes';

    protected $fillable = [
        'fechaInicio',
        'fechaFin',
        'horaInicio',
        'horaFin',
        'actividadAcademica',
        'asistentesEstimados',
        'aproboSolicitud',
        'estado',
        'tipoUsuario',
        'motivo',
        'usuarioSolicitud',
        'area_id',
        'espacio_id',
        'notificacion',

        'tipoRegistro',
        'docente',
        'grupo',
        'semestre',
        'carrera',
    ];

    public function elementos()
    {
        return $this->belongsToMany(Elemento::class);
    }

    public function aprobo()
    {
        return $this->belongsTo(User::class, 'aproboSolicitud');
    }

    public function solicitante()
    {
        return $this->belongsTo(Usuario::class, 'usuarioSolicitud', 'id');
    }

    public function solicitanteAdmin()
    {
        return $this->belongsTo(User::class, 'usuarioSolicitud', 'id');
    }

    public function espacio()
    {
        return $this->belongsTo(Espacio::class, 'espacio_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function getFechaInicioAttribute($date)
    {
        return new Date($date);
    }
    public function getFechaFinAttribute($date)
    {
        return new Date($date);
    }

    // public function getHoraInicioAttribute($date)
    // {
    //     return new Date($date);
    // }
    // public function getHoraFinAttribute($date)
    // {
    //     return new Date($date);
    // }

    public function elementosSolicitud()
    {
        return $this->belongsToMany(Elemento::class)
            ->withPivot('elemento_id', 'cantidad', 'id')
            ->withTimestamps();
    }

    public function notificacion()
    {
        return $this->belongsTo(Notificacion::class);
    }

    public function evaluacion()
    {
        return $this->belongsTo(Evaluaciones::class, 'id', 'solicitud_id');
    }

    public function getFechaInicioAttibute()
    {
        return $this->fechaInicio->format('dd-mm-yyyy');
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

    public function tipoUsuario($solicitud)
    {
        if ($solicitud->tipoUsuario == 0 || $solicitud->tipoUsuario == 1) {
            return $usuario = User::find($solicitud->usuarioSolicitud);
        } else {
            return $usuario = Usuario::find($solicitud->usuarioSolicitud);
        }
    }

    public function nombreUsuarioSolicitante($solicitud)
    {
        if ($solicitud->tipoUsuario == 0 || $solicitud->tipoUsuario == 1) {
            $usuario = User::find($solicitud->usuarioSolicitud);
            return $usuario->nombre . ' ' . $usuario->apellidoP . ' ' . $usuario->apellidoM;
        } else {
            $usuario = Usuario::find($solicitud->usuarioSolicitud);
            return $usuario->nombre . ' ' . $usuario->apellidoP . ' ' . $usuario->apellidoM;
        }
    }

    public function scopeRegistroTranslapado($query, $data)
    {
        return $query->where('fechaInicio', $data['fechaInicio'])
            ->where('estado', $data['estado'])
            ->where('espacio_id', $data['espacio_id'])
            ->whereBetween('horaInicio', [$data['horaInicio'], $data['horaFin']])
            ->orwhereBetween('horaFin', [$data['horaInicio'], $data['horaFin']])
            ->where('espacio_id', $data['espacio_id'])
            ->where('estado', $data['estado'])
            ->where('fechaInicio', $data['fechaInicio'])
            ->get();
    }

    public function aproboSolicitud($aproboSolicitud)
    {
        return User::find($aproboSolicitud);
    }

}

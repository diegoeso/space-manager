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

    public function elementosSolicitud()
    {
        return $this->belongsToMany(Elemento::class)
            ->withPivot('elemento_id', 'cantidad', 'id')
            ->withTimestamps();
    }

    // public static function solicitudes()
    // {
    //     return static::orderBy('id', 'DESC')
    //         ->where('estado', 0)
    //         ->get();
    // }

    public function notificacion()
    {
        return $this->belongsTo(Notificacion::class);
    }

    public function evaluacion()
    {
        return $this->belongsTo(Evaluaciones::class);
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

    public function tipoUsuario($solicitud)
    {
        if ($solicitud->tipoUsuario == 0 || $solicitud->tipoUsuario == 1) {
            return $usuario = User::find($solicitud->usuarioSolicitud);
        } else {
            return $usuario = Usuario::find($solicitud->usuarioSolicitud);
        }
    }

}

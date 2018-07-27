<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class SolicitudElementos extends Model
{
    protected $table = 'solicitud_elementos';

    protected $fillable = [
        'fecha',
        'horaInicio',
        'horaFin',
        'estado',
        'cantidad',
        'usuarioSolicitud',
        'tipoUsuario',
        'aproboSolicitud',
        'categoria_id',
        'elemento_id',
        'notificacion',

    ];

    public function elemento()
    {
        return $this->belongsTo(Elemento::class);
    }

    public function categoria()
    {
        return $this->belongsTo(CategoriaElemento::class);
    }

    public function getFechaAttribute($date)
    {
        return new Date($date);
    }

    public function solicitante()
    {
        return $this->belongsTo(Usuario::class, 'usuarioSolicitud', 'id');
    }
}

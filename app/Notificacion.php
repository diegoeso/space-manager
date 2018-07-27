<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Notificacion extends Model
{
    protected $table    = 'notificaciones';
    protected $fillable = [
        'solicitud_id',
        'estado',
        'uri',
    ];

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'solicitud_id');
    }

    public function getCreatedAtAttribute($date)
    {
        return new Date($date);
    }
}

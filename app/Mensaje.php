<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Mensaje extends Model
{
    protected $fillable = [
        'asunto',
        'mensaje',
        'de',
        'para',
        'solicitud_id',
        'leido',
    ];

    public function getCreatedAtAttribute($date)
    {
        return new Date($date);
    }
}

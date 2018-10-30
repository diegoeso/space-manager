<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Mensaje extends Model
{
    protected $fillable = [
        'de',
        'para',
        'solicitud_id',
        'asunto',
        'mensaje',
        'leido',
    ];
    public function getCreatedAtAttribute($date)
    {
        return new Date($date);
    }

    public function getUpdatedAtAttribute($date)
    {
        return new Date($date);
    }

    public function getNombre($email)
    {
        $user = User::where('email', $email)->get();
        if ($user != null) {
            return $user;
        } else {
            $user = Usuario::where('email', $email)->get();
            return $user;
        }

    }
}

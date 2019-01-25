<?php

namespace App\Policies;

use App\Solicitud;
use App\Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;

class SolicitudPolicy
{
    use HandlesAuthorization;
    public function __construct()
    {
        //
    }

    public function pass(Usuario $usuario, Solicitud $solicitud)
    {
        return $usuario->id == $solicitud->usuarioSolicitud;
    }
}

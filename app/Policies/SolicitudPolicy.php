<?php

namespace App\Policies;

// use App\User;
use App\Solicitud;
use App\Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;

class SolicitudPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function pass(Usuario $usuario, Solicitud $solicitud)
    {
        return $usuario->id == $solicitud->usuarioSolicitud;
    }
}

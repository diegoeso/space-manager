<?php

namespace App\Policies;

use App\Solicitud;
use App\Area;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResponsableSolicitud
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

     public function res_pass(Solicitud $solicitud, Area $area)
    {
        return $solicitud->id_area == $area->user_id;
    }
}

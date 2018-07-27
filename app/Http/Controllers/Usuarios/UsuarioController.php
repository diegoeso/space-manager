<?php

namespace App\Http\Controllers\Usuarios;

use App\Area;
use App\Http\Controllers\Controller;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:usuario');

    }

    public function dashboard()
    {
        $areasE = Area::pluck('nombre', 'id');
        return view('usuarios.dashboard', compact('areasE'));
    }

}

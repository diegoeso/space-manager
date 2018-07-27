<?php

namespace App\Http\Controllers;

use App\User;
use App\Usuario;
use Auth;
use Illuminate\Http\Request;
use Toastr;

class GeneralController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:usuario,web');

    }

    public function perfil()
    {
        $tipoCuenta = Auth::user()->tipoCuenta;
        if ($tipoCuenta == 0 || $tipoCuenta == 1) {
            $usuario = User::find(Auth::user()->id);
            return view('layouts.perfil', compact('usuario'));
        } else {
            $usuario = Usuario::find(Auth::user()->id);
            return view('layouts.perfil', compact('usuario'));
        }
    }

    public function update(Request $request, $id)
    {
        $usuario            = Usuario::find($id);
        $usuario->nombre    = $request->nombre;
        $usuario->apellidoP = $request->apellidoP;
        $usuario->apellidoM = $request->apellidoM;
        $usuario->nickname  = $request->nickname;
        $usuario->email     = $request->email;
        $usuario->telefono  = $request->telefono;
        if (!empty($request->password)) {
            $usuario->password = bcrypt($request->password);
        }
        // $usuario->tipoCuenta = $request->tipoCuenta;
        if ($request->hasFile('foto')) {
            $usuario->foto = $request->file('foto')->store('public');
        }
        $usuario->nombreCompleto = $request->nombre . ' ' . $request->apellidoP . ' ' . $request->apellidoM;
        $usuario->confirmacion   = $request->confirmacion;
        $usuario->carrera        = $request->carrera;
        $usuario->semestre       = $request->semestre;
        $usuario->matricula      = $request->matricula;

        if ($usuario->save()) {
            Toastr::success('¡Ya haz completado el registro!', '¡Hecho!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
            return redirect('/inicio');
        } else {
            return back()->with('info', 'Error al editar registro, comprueba los datos');
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Area;
use App\Espacio;
use App\Solicitud;
use App\User;
use App\Usuario;
use Auth;
use DB;
use Illuminate\Http\Request;
use Toastr;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitudes           = Solicitud::all();
        $areas                 = Area::all();
        $espacios              = Espacio::all();
        $usuarios              = Usuario::all();
        $areasE                = Area::pluck('nombre', 'id');
        $solicitudesPendientes = Solicitud::where('estado', 0)
            ->orderBy('created_at', 'ASC')
            ->paginate(5);
        $graficas = Solicitud::select(DB::raw('count(*) as total, espacio_id'))
            ->where('tipoRegistro', 0)->groupBy('espacio_id')->get();
        // dd($graficas);
        return view('admins.dashboard', compact('solicitudes', 'areas', 'areasE', 'usuarios', 'solicitudesPendientes', 'espacios', 'graficas'));
    }

    public function perfil()
    {
        $user = User::find(Auth::user()->id);
        return view('admins.perfil', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->nombre    = $request->nombre;
        $user->apellidoP = $request->apellidoP;
        $user->apellidoM = $request->apellidoM;
        $user->nickname  = $request->nickname;
        $user->email     = $request->email;
        $user->telefono  = $request->telefono;
        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }
        // $user->tipoCuenta = $request->tipoCuenta;
        if ($request->hasFile('foto')) {
            $user->foto = $request->file('foto')->store('public');
        }
        $user->nombreCompleto = $request->nombre . ' ' . $request->apellidoP . ' ' . $request->apellidoM;

        if ($user->save()) {
            Toastr::success('¡Datos actualizados!', '¡Hecho!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
            return back();
        } else {
            Toastr::error('¡Error al actualizar datos!', '¡Error!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
            return back();
        }
    }
}

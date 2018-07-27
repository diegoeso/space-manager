<?php

namespace App\Http\Controllers\Admins;

use App\CategoriaElemento;
use App\Espacio;
use App\Http\Controllers\Controller;
use App\SolicitudElementos;
use App\User;
use App\Usuario;
use Auth;
use Illuminate\Http\Request;
use Toastr;
use Yajra\DataTables\DataTables;

class SolicitudElementosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.solicitudesElementos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = CategoriaElemento::pluck('nombre', 'id');
        return view('admins.solicitudesElementos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fecha                       = date("Y-m-d", strtotime($request->fecha));
        $horaInicio                  = date("H:i:s", strtotime($request->horaInicio));
        $horaFin                     = date("H:i:s", strtotime($request->horaFin));
        $solicitud                   = new SolicitudElementos;
        $solicitud->fecha            = $fecha;
        $solicitud->horaInicio       = $horaInicio;
        $solicitud->horaFin          = $horaFin;
        $solicitud->estado           = 0;
        $solicitud->cantidad         = $request->cantidad;
        $solicitud->usuarioSolicitud = Auth::user()->id;
        $solicitud->tipoUsuario      = Auth::user()->tipoCuenta;
        $solicitud->categoria_id     = $request->categoria_id;
        $solicitud->elemento_id      = $request->elemento_id;
        $solicitud->notificacion     = 0;

        if ($solicitud->save()) {
            Toastr::success('¡Registro exitoso!', '¡Hecho!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
            return redirect()->route('solicitud-elementos.show', $solicitud->id);
        } else {
            Toastr::error('¡Error al realizar el registro!', '¡Error!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $solicitud = SolicitudElementos::find($id);
        return view('admins.solicitudesElementos.show', compact('solicitud'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $solicitud  = SolicitudElementos::find($id);
        $categorias = CategoriaElemento::pluck('nombre', 'id');
        return view('admins.solicitudesElementos.edit', compact('solicitud', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fecha                       = date("Y-m-d", strtotime($request->fecha));
        $horaInicio                  = date("H:i:s", strtotime($request->horaInicio));
        $horaFin                     = date("H:i:s", strtotime($request->horaFin));
        $solicitud                   = SolicitudElementos::find($id);
        $solicitud->fecha            = $fecha;
        $solicitud->horaInicio       = $horaInicio;
        $solicitud->horaFin          = $horaFin;
        $solicitud->estado           = 0;
        $solicitud->cantidad         = $request->cantidad;
        $solicitud->usuarioSolicitud = Auth::user()->id;
        $solicitud->tipoUsuario      = Auth::user()->tipoCuenta;
        $solicitud->categoria_id     = $request->categoria_id;
        $solicitud->elemento_id      = $request->elemento_id;
        $solicitud->notificacion     = 0;

        if ($solicitud->save()) {
            Toastr::success('¡Registro exitoso!', '¡Hecho!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
            return redirect()->route('solicitud-elementos.show', $solicitud->id);
        } else {
            Toastr::error('¡Error al realizar el registro!', '¡Error!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function listarSolicitudes($id)
    {
        $solicitudes = SolicitudElementos::all();
        return Datatables::of($solicitudes)
            ->editColumn('elemento_id', function ($solicitudes) {
                return $solicitudes->elemento->nombre;
            })
            ->editColumn('categoria_id', function ($solicitudes) {
                return $solicitudes->categoria->nombre;
            })
            ->editColumn('fecha', function ($solicitudes) {
                return $solicitudes->fecha->format('l j  F');
            })
            ->editColumn('created_at', function ($solicitudes) {
                return $solicitudes->created_at->diffForHumans();
            })

            ->addColumn('action', function ($solicitudes) {
                return '<a href="' . route("solicitudes-elementos.aprobar", $solicitudes->id) . '" class="btn btn-success btn-xs"><i class="fa fa-check-square-o"></i></a> ' .
                '<a href="' . route('solicitudes-elementos.edit', $solicitudes->id) . '" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-edit"></i></a> ' .
                '<a onclick="deleteData(' . $solicitudes->id . '" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->make(true);
    }

    public function cancelar($id)
    {
        $solicitud         = SolicitudElementos::find($id);
        $solicitud->estado = 3;
        if ($solicitud->save()) {
            Toastr::success('¡Cancelacion exitosa!', '¡Hecho!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
            return back();
        } else {
            Toastr::error('¡Error al cancelar solicitud!', '¡Error!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
            return back();
        }
    }

    public function aprobar($id)
    {
        $solicitud = SolicitudElementos::find($id);
        dd($solicitud);
        // $fecha      = date("Y-m-d", strtotime($solicitud->fecha));
        // $horaInicio = date("H:i:s", strtotime($solicitud->horaInicio));
        // $horaFin    = date("H:i:s", strtotime($solicitud->horaFin));

        // $solicitudesPendientes = Solicitud::where('fechaInicio', $fechaInicio)
        //     ->where('estado', $estado)
        //     ->where('espacio_id', $espacio_id)
        //     ->whereBetween('horaInicio', [$horaInicio, $horaFin])
        //     ->orwhereBetween('horaFin', [$horaInicio, $horaFin])
        //     ->where('espacio_id', $espacio_id)
        //     ->where('fechaInicio', $fechaInicio)
        //     ->where('estado', $estado)
        //     ->get();

    }

    public function rechazar(Request $request, $id)
    {
        $solicitud = Solicitud::find($id);
        $espacio   = Espacio::find($solicitud->espacio_id);
        if ($solicitud->tipoUsuario == 0 || $solicitud->tipoUsuario == 1) {
            $usuario = User::find($solicitud->usuarioSolicitud);
        } else {
            $usuario = Usuario::find($solicitud->usuarioSolicitud);
        }
        $data['id']          = $usuario->id;
        $data['nombre']      = $usuario->nombre;
        $data['apellidoP']   = $usuario->apellidoP;
        $data['email']       = $usuario->email;
        $data['fechaInicio'] = $solicitud->fechaInicio;
        $data['fechaFin']    = $solicitud->fechaFin;
        $data['horaInicio']  = $solicitud->horaInicio;
        $data['horaFin']     = $solicitud->horaFin;
        $data['espacio']     = $espacio->nombre;

        if ($solicitud->estado != 2) {
            $fechaI            = $solicitud->fechaInicio->format('l j F');
            $horaI             = $solicitud->horaInicio;
            $solicitud->estado = 2;
            $solicitud->motivo = $request->motivo;
            $data['motivo']    = $solicitud->motivo;
            if ($solicitud->save()) {
                $id = $solicitud->id;
                $this->notificacion($id);
                if ($solicitud->tipoUsuario == 0 || $solicitud->tipoUsuario == 1) {
                    // datos de users
                    Toastr::warning('Solicitud de' . ' ' . $solicitud->solicitanteAdmin->nombreCompleto . '<br/>' . ' Espacio:  ' . $solicitud->espacio->nombre . '<br/>' . 'Fecha: ' . $fechaI . ' ' . $horaI . '<br/>', '¡Rechazada!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
                } else {
                    // datos de usuarios
                    Toastr::warning('Solicitud de' . ' ' . $solicitud->solicitante->nombreCompleto . '<br/>' . ' Espacio:  ' . $solicitud->espacio->nombre . '<br/>' . 'Fecha: ' . $fechaI . ' ' . $horaI . '<br/>', '¡Rechazada!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
                }
                return back();
            }
        }

        Toastr::warning('La solicitud ya ha sido rechazada', '¡Alerta!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
        return back();
    }

    public function notificacion($id)
    {
        $notificacion               = new Notificacion;
        $notificacion->solicitud_id = $id;
        $notificacion->uri          = 'solicitudes.ver';
        $notificacion->estadoAdmin  = 0;
        $notificacion->estadoRes    = 0;
        $notificacion->estadoUsu    = 0;
        $notificacion->save();
    }
}

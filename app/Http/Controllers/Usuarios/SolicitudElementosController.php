<?php

namespace App\Http\Controllers\Usuarios;

use App\CategoriaElemento;
use App\Http\Controllers\Controller;
use App\SolicitudElementos;
use Auth;
use Illuminate\Http\Request;
use Toastr;
use Yajra\DataTables\DataTables;

class SolicitudElementosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:usuario');
        $this->middleware('completarRegistro');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('usuarios.solicitudesElementos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = CategoriaElemento::pluck('nombre', 'id');
        return view('usuarios.solicitudesElementos.create', compact('categorias'));
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
        return view('usuarios.solicitudesElementos.show', compact('solicitud'));
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
        return view('usuarios.solicitudesElementos.edit', compact('solicitud', 'categorias'));
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
        $solicitudes = SolicitudElementos::where('usuarioSolicitud', Auth::user()->id)->get();
        // dd($solicitudes);

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
                return '<a href="' . route("solicitud-elementos.show", $solicitudes->id) . '" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a> ' .
                '<a href="' . route('solicitud-elementos.edit', $solicitudes->id) . '" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-edit"></i></a> ' .
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
}

<?php

namespace App\Http\Controllers\Usuarios;

use App;
use App\Area;
use App\Elemento;
use App\Evaluaciones;
use App\Http\Controllers\Controller;
use App\Http\Requests\SolicitudRequest;
use App\Notificacion;
use App\Solicitud;
use App\Traits\Alertas;
use App\Traits\Elementos;
use Auth;
use DB;
use Illuminate\Http\Request;
use PDF;
use Toastr;
use Yajra\DataTables\DataTables;

class SolicitudController extends Controller
{
    use Elementos, Alertas;
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
        return view('usuarios.solicitudes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::pluck('nombre', 'id');
        return view('usuarios.solicitudes.create', compact('areas', 'solicitudes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SolicitudRequest $request)
    {
        $fechaInicio = date("Y-m-d", strtotime($request->fechaInicio));
        $fechaFin    = date("Y-m-d", strtotime($request->fechaFin));
        $horaInicio  = date("H:i:s", strtotime($request->horaInicio));
        $horaFin     = date("H:i:s", strtotime($request->horaFin));
        $espacio     = $request->espacio_id;

        $solicitudAprobadas = Solicitud::where('fechaInicio', $fechaInicio)
            ->where('estado', 1)
            ->where('espacio_id', $espacio)
            ->whereBetween('horaInicio', [$horaInicio, $horaFin])
            ->orwhereBetween('horaFin', [$horaInicio, $horaFin])
            ->where('espacio_id', $espacio)
            ->where('fechaInicio', $fechaInicio)
            ->where('estado', 1)
            ->get();

        if (count($solicitudAprobadas) > 0) {
            $this->solicitudExistente();
            return back();
        }

        $solicitud                      = new Solicitud;
        $solicitud->fechaInicio         = $fechaInicio;
        $solicitud->fechaFin            = $fechaFin;
        $solicitud->horaInicio          = $request->horaInicio;
        $solicitud->horaFin             = $request->horaFin;
        $solicitud->actividadAcademica  = $request->actividadAcademica;
        $solicitud->asistentesEstimados = $request->asistentesEstimados;
        $solicitud->usuarioSolicitud    = Auth::user()->id;
        $solicitud->tipoUsuario         = Auth::user()->tipoCuenta;
        $solicitud->area_id             = $request->area_id;
        $solicitud->espacio_id          = $request->espacio_id;

        // si guarda el registro en solicitudes añade las relaciones de los elementos solicitados
        if ($solicitud->save()) {
            $this->notificacion($solicitud->id);
            if ($request->cantidad) {
                $manyToMany = array();
                for ($i = 0; $i < count($request->cantidad); $i++) {
                    // Restar elementos solicitados
                    $elemento              = Elemento::find($request->elemento_id[$i]);
                    $elemento->existencias = $elemento->existencias - $request->cantidad[$i];
                    $elemento->save();

                    $manyToMany[$request->elemento_id[$i]] = ['cantidad' => $request->cantidad[$i]];
                }
                // agrega los elementos a la tabla pivote
                $solicitud->elementosSolicitud()->sync($manyToMany);
            }
            $this->registroExitoso();
            return redirect()->route('solicitud.show', $solicitud->id);
        } else {
            $this->registroError();
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
        $evaluacion = Evaluaciones::where('solicitud_id', $id)
            ->where('evaluador', Auth::user()->id)->first();
        $solicitud = Solicitud::find($id);
        $this->authorize('pass', $solicitud);
        return view('usuarios.solicitudes.show', compact('solicitud', 'evaluacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $solicitud = Solicitud::find($id);
        $areas     = Area::pluck('nombre', 'id');
        $this->authorize('pass', $solicitud);
        return view('usuarios.solicitudes.edit', compact('solicitud', 'areas'));
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
        $fechaInicio                    = date("Y-m-d", strtotime($request->fechaInicio));
        $fechaFin                       = date("Y-m-d", strtotime($request->fechaFin));
        $solicitud                      = Solicitud::find($id);
        $solicitud->fechaInicio         = $fechaInicio;
        $solicitud->fechaFin            = $fechaFin;
        $solicitud->horaInicio          = $request->horaInicio;
        $solicitud->horaFin             = $request->horaFin;
        $solicitud->actividadAcademica  = $request->actividadAcademica;
        $solicitud->asistentesEstimados = $request->asistentesEstimados;
        $solicitud->area_id             = $request->area_id;
        $solicitud->espacio_id          = $request->espacio_id;
        // si guarda el registro en solicitudes añade las relaciones de los elementos solicitados
        if ($solicitud->save()) {
            // Relaciones
            if ($request->cantidad) {
                $manyToMany = array();
                for ($i = 0; $i < count($request->cantidad); $i++) {
                    //----resta el elemento seleccionado de las existencias
                    $elemento = Elemento::find($request->elemento_id[$i]);

                    $el = DB::table('elemento_solicitud')->select('cantidad')->where('elemento_id', $request->elemento_id[$i])->first();
                    if ($el != null) {
                        if ($el->cantidad != $request->cantidad[$i]) {
                            $elemento->existencias = $elemento->existencias + $el->cantidad;
                            $elemento->existencias = $elemento->existencias - $request->cantidad[$i];
                            $elemento->save();
                        }
                    } else {
                        $elemento->existencias = $elemento->existencias - $request->cantidad[$i];
                        $elemento->save();
                    }
                    //----Fin
                    $manyToMany[$request->elemento_id[$i]] = ['cantidad' => $request->cantidad[$i]];
                }
                $solicitud->elementosSolicitud()->sync($manyToMany);
            }
            // Registro exitoso
            $this->notificacion($solicitud->id);
            $this->registroExitoso();
            return redirect()->route('solicitud.show', $solicitud->id);
        } else {
            $this->registroError();
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
        $solicitud = Solicitud::FindOrFail($id);
        $this->debolverElementos($solicitud->id);
        $result = $solicitud->delete();
        if ($result) {
            return response()->json(['success' => 'true']);
        } else {
            return response()->json(['success' => 'false']);
        }
    }

    public function ver($id)
    {
        $notificacion = Notificacion::where('id', $id)->first();
        if ($notificacion->estado == 0) {
            $notificacion->estadoUsu = 1;
            $notificacion->save();
        }

        $solicitud   = Solicitud::find($notificacion->solicitud->id);
        $fechaInicio = date("Y-m-d", strtotime($solicitud->fechaInicio));
        $fechaFin    = date("Y-m-d", strtotime($solicitud->fechaFin));
        $horaInicio  = date("H:i:s", strtotime($solicitud->horaInicio));
        $horaFin     = date("H:i:s", strtotime($solicitud->horaFin));
        $espacio_id  = $solicitud->espacio_id;
        $estado      = $solicitud->estado;
        $bandera     = null;

        $evaluacion = Evaluaciones::where('solicitud_id', $id)
            ->where('evaluador', Auth::user()->id)->first();

        if ($estado == 1 || $estado == 2 || $estado == 3) {
            $bandera = 0;

            return view('usuarios.solicitudes.show', compact('solicitud', 'bandera', 'evaluacion'));
        } else {
            $solicitudesPendientes = Solicitud::where('fechaInicio', $fechaInicio)
                ->where('estado', $estado)
                ->where('espacio_id', $espacio_id)
                ->whereBetween('horaInicio', [$horaInicio, $horaFin])
                ->orwhereBetween('horaFin', [$horaInicio, $horaFin])
                ->where('espacio_id', $espacio_id)
                ->where('estado', $estado)
                ->where('fechaInicio', $fechaInicio)
                ->get();

            $bandera = 1;
            return view('usuarios.solicitudes.show', compact('solicitudesPendientes', 'bandera', 'evaluacion'));
        }
    }

    public function cancelar(Request $request)
    {
        $solicitud = Solicitud::find($request->solicitud_id);
        if ($solicitud->estado == 3) {
            Toastr::warning('¡La solicitud ya ha sido cancelada!', '¡Alerta!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
            return back();
        } else {
            $solicitud->estado = 3;
            $solicitud->motivo = $request->motivo;
            if ($solicitud->save()) {
                Toastr::success('¡Cancelacion exitosa!', '¡Hecho!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
                return back();
            } else {
                Toastr::error('¡Error al cancelar solicitud!', '¡Error!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
                return back();
            }
        }

    }

    public function listarSolicitudes($id)
    {
        $solicitudes = Solicitud::where('usuarioSolicitud', Auth::user()->id)->get();
        return Datatables::of($solicitudes)
            ->editColumn('usuarioSolicitud', function ($solicitudes) {
                return $solicitudes->solicitante->nombre . ' ' . $solicitudes->solicitante->apellidoP . ' ' . $solicitudes->solicitante->apellidoM;
            })
            ->editColumn('tipoUsuario', function ($solicitudes) {
                switch ($solicitudes->tipoUsuario) {
                    case '0':
                        return 'Administrador';
                        break;
                    case '1':
                        return 'Responsable de Area';
                        break;
                    case '2':
                        return 'Profesor';
                        break;
                    case '3':
                        return 'Alumno';
                        break;
                    default:
                        return 'Usuario';
                        break;
                }
            })
            ->editColumn('espacio_id', function ($solicitudes) {
                return $solicitudes->espacio->nombre;
            })
            ->editColumn('fechaInicio', function ($solicitudes) {
                return $solicitudes->fechaInicio->format('l j  F');
            })
            ->editColumn('created_at', function ($solicitudes) {
                return $solicitudes->created_at->diffForHumans();
            })
            ->addColumn('action', function ($solicitudes) {
                return '<a href="' . route("solicitud.show", $solicitudes->id) . '" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a> ' .
                '<a href="' . route('solicitud.edit', $solicitudes->id) . '" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-edit"></i></a> ' .
                '<a href="#" value="' . $solicitudes->id . '" class="btn btn-danger btn-xs" id="btnEliminar"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->make(true);
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

    public function solicitudes()
    {
        $fecha = date('d-m-Y/h:i:s');
        $pdf   = App::make('dompdf.wrapper');
        $data  = Solicitud::where('usuarioSolicitud', Auth::user()->id)->get();
        $pdf   = PDF::loadView('usuarios.solicitudes.pdfSolicitudes', ['data' => $data]);
        // ->setPaper('a4', 'landscape');

        // return $pdf->stream();
        return $pdf->download('solicitudes_' . $fecha . ' . pdf');
    }

    public function solicitud($id)
    {
        $fecha     = date('d-m-Y / h:i:s');
        $pdf       = App::make('dompdf.wrapper');
        $solicitud = Solicitud::find($id);
        $pdf       = PDF::loadView('usuarios.solicitudes.pdf', ['solicitud' => $solicitud]);
        // return $pdf->stream();
        return $pdf->download('solicitud_' . $solicitud->tipoUsuario($solicitud)->fullName . '_' . $fecha . ' . pdf');
    }
}

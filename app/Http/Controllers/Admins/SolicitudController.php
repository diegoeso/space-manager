<?php

namespace App\Http\Controllers\Admins;

use App;
use App\Area;
use App\Elemento;
use App\Espacio;
use App\Evaluaciones;
use App\Exports\SolicitudExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SolicitudRequest;
use App\Notificacion;
use App\Services\PayUService\Exception;
use App\Solicitud;
use App\Traits\Alertas;
use App\Traits\Elementos;
use App\Traits\Email;
use App\User;
use App\Usuario;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Toastr;
use Yajra\DataTables\DataTables;

class SolicitudController extends Controller
{
    use Elementos;
    use Alertas;
    use Email;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:solicitudes.index')->only('index');
        $this->middleware('permission:solicitudes.create')->only(['create', 'store']);
        $this->middleware('permission:solicitudes.show')->only('show');
        $this->middleware('permission:solicitudes.edit')->only(['edit', 'update']);
        $this->middleware('permission:solicitudes.destroy')->only('destroy');
        $this->middleware('permission:solicitudes.confirmar')->only('aprobar');
        $this->middleware('permission:solicitudes.rechazar')->only('rechazar');
        $this->middleware('permission:solicitudes.cancelar')->only('cancelar');
        Carbon::setLocale('es');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.solicitudes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::pluck('nombre', 'id');
        return view('admins.solicitudes.create', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SolicitudRequest $request)
    {
        $fechaInicio        = date("Y-m-d", strtotime($request->fechaInicio));
        $fechaFin           = date("Y-m-d", strtotime($request->fechaFin));
        $horaInicio         = date("H:i:s", strtotime($request->horaInicio));
        $horaFin            = date("H:i:s", strtotime($request->horaFin));
        $espacio            = $request->espacio_id;
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
        $solicitud->estado              = 1;

        // si guarda el registro en solicitudes añade las relaciones de los elementos solicitados
        if ($solicitud->save()) {
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
            $id = $solicitud->id;
            $this->notificacion($id);
            $this->registroExitoso();
            return redirect()->route('solicitudes.show', $solicitud->id);
        } else {
            $this->registroError();
            $bandera = false;
            return back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ver($id)
    {
        $notificacion = Notificacion::where('id', $id)->first();
        if (!$notificacion) {
            return abort(404);
        }

        if ($notificacion->estado == 0) {
            if (Auth::user()->tipoCuenta == 0) {
                $notificacion->estadoAdmin = 1;
            } else {
                $notificacion->estadoRes = 1;
            }
            $notificacion->save();
        }

        $solicitud = Solicitud::find($notificacion->solicitud->id);

        $data['fechaInicio'] = date("Y-m-d", strtotime($solicitud->fechaInicio));
        $data['fechaFin']    = date("Y-m-d", strtotime($solicitud->fechaFin));
        $data['horaInicio']  = date("H:i:s", strtotime($solicitud->horaInicio));
        $data['horaFin']     = date("H:i:s", strtotime($solicitud->horaFin));
        $data['espacio_id']  = $solicitud->espacio_id;
        $data['estado']      = $solicitud->estado;

        $total = Evaluaciones::where('estado', 1)->orderBy('evaluado')->orderBy('solicitud_id')->get();

        $bandera = null;
        if ($solicitud->estado == 1 || $solicitud->estado == 2 || $solicitud->estado == 3) {
            $bandera = 0;
            return view('admins.solicitudes.show', compact('solicitud', 'bandera', 'total'));
        } else {
            $solicitudesPendientes = Solicitud::registroTranslapado($data);
            $bandera               = 1;
            return view('admins.solicitudes.show', compact('solicitudesPendientes', 'bandera', 'total'));
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
        $solicitud = Solicitud::find($id);
        if (!$solicitud) {
            return abort(404);
        }
        switch (Auth::user()->tipoCuenta) {
            case 0:
                $data['fechaInicio'] = date("Y-m-d", strtotime($solicitud->fechaInicio));
                $data['fechaFin']    = date("Y-m-d", strtotime($solicitud->fechaFin));
                $data['horaInicio']  = date("H:i:s", strtotime($solicitud->horaInicio));
                $data['horaFin']     = date("H:i:s", strtotime($solicitud->horaFin));
                $data['espacio_id']  = $solicitud->espacio_id;
                $data['estado']      = $solicitud->estado;
                $total               = Evaluaciones::where('estado', 1)->orderBy('evaluado')->orderBy('solicitud_id')->get();
                $bandera             = null;
                if ($solicitud->estado == 1 || $solicitud->estado == 2 || $solicitud->estado == 3) {
                    $bandera = 0;
                    return view('admins.solicitudes.show', compact('solicitud', 'bandera', 'total'));
                } else {
                    $solicitudesPendientes = Solicitud::registroTranslapado($data);
                    $bandera               = 1;
                    return view('admins.solicitudes.show', compact('solicitudesPendientes', 'bandera', 'total'));
                }
                break;

            case 1:

                for ($i = 0; $i < count(Auth::user()->area); $i++) {
                    if (Auth::user()->area[$i]->id == $solicitud->area_id) {
                        $data['fechaInicio'] = date("Y-m-d", strtotime($solicitud->fechaInicio));
                        $data['fechaFin']    = date("Y-m-d", strtotime($solicitud->fechaFin));
                        $data['horaInicio']  = date("H:i:s", strtotime($solicitud->horaInicio));
                        $data['horaFin']     = date("H:i:s", strtotime($solicitud->horaFin));
                        $data['espacio_id']  = $solicitud->espacio_id;
                        $data['estado']      = $solicitud->estado;
                        $total               = Evaluaciones::where('estado', 1)->orderBy('evaluado')->orderBy('solicitud_id')->get();
                        $bandera             = null;
                        if ($solicitud->estado == 1 || $solicitud->estado == 2 || $solicitud->estado == 3) {
                            $bandera = 0;
                            return view('admins.solicitudes.show', compact('solicitud', 'bandera', 'total'));
                        } else {
                            $solicitudesPendientes = Solicitud::registroTranslapado($data);
                            $bandera               = 1;
                            return view('admins.solicitudes.show', compact('solicitudesPendientes', 'bandera', 'total'));
                        }
                    } 
               }

                Toastr::warning('Esta solicitud no corresponde al área que administra', '¡Alerta!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
                        return back();
                
                break;
        }
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
        if (!$solicitud) {
            return abort(404);
        }

        return view('admins.solicitudes.edit', compact('solicitud', 'areas'));
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
        // dd(count($request->cantidad));
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
            return redirect()->route('solicitudes.show', $solicitud->id);
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

    public function listarSolicitudes($id)
    {
        if (Auth::user()->tipoCuenta === 0) {
            $solicitudes = Solicitud::where('tipoRegistro', 0)->get();
        } else {
            $solicitudes = Solicitud::where('tipoRegistro', 0)
                ->whereHas('area', function ($query) {
                    $query->where('user_id', Auth::user()->id)
                        ->groupBy('user_id')
                    ;})
                ->get();
        }

        return Datatables::of($solicitudes)

            ->editColumn('usuarioSolicitud', function ($solicitudes) {
                return $solicitudes->nombreUsuarioSolicitante($solicitudes);
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
            ->editColumn('horaInicio', function ($solicitudes) {
                return $solicitudes->horaInicio . ' a ' . $solicitudes->horaFin;
            })
            ->editColumn('created_at', function ($solicitudes) {
                return $solicitudes->created_at->diffForHumans();
            })
            ->addColumn('action', function ($solicitudes) {
                return '<a href="' . route("solicitudes.show", $solicitudes->id) . '" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a> ' .
                '<a href="' . route('solicitudes.edit', $solicitudes->id) . '" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-edit"></i></a> ' .
                '<a href="#" value="' . $solicitudes->id . '" class="btn btn-danger btn-xs" id="btnEliminar"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->make(true);
    }

    public function aprobar($id)
    {
        $solicitud = Solicitud::find($id);

        $data['fechaInicio'] = date("Y-m-d", strtotime($solicitud->fechaInicio));
        $data['fechaFin']    = date("Y-m-d", strtotime($solicitud->fechaFin));
        $data['horaInicio']  = date("H:i:s", strtotime($solicitud->horaInicio));
        $data['horaFin']     = date("H:i:s", strtotime($solicitud->horaFin));
        $data['espacio_id']  = $solicitud->espacio_id;
        $data['estado']      = $solicitud->estado;
        // scope model Solicitud
        $solicitudesPendientes = Solicitud::registroTranslapado($data);
        foreach ($solicitudesPendientes as $solicitudP) {
            if ($solicitudP->id == $id) {
                $solicitudAprobada = Solicitud::find($id);
                // Email
                $data['id']          = $solicitudAprobada->tipoUsuario($solicitudAprobada)->id;
                $data['nombre']      = $solicitudAprobada->tipoUsuario($solicitudAprobada)->nombre;
                $data['apellidoP']   = $solicitudAprobada->tipoUsuario($solicitudAprobada)->apellidoP;
                $data['email']       = $solicitudAprobada->tipoUsuario($solicitudAprobada)->email;
                $data['fechaInicio'] = $solicitudAprobada->fechaInicio;
                $data['fechaFin']    = $solicitudAprobada->fechaFin;
                $data['horaInicio']  = $solicitudAprobada->horaInicio;
                $data['horaFin']     = $solicitudAprobada->horaFin;
                $data['espacio']     = $solicitudAprobada->espacio->nombre;
                if ($solicitudAprobada->estado != 1) {
                    $solicitudAprobada->estado          = 1;
                    $solicitudAprobada->aproboSolicitud = Auth::user()->id;
                    if ($solicitudAprobada->save()) {
                        $this->notificacion($solicitudAprobada->id);
                        $this->crearEvaluacion($solicitudAprobada->id);
                        try {
                            $this->enviarEmailSolicitudAprobada($data);
                        } catch (\Exception $e) {
                            Log::notice('No se pudo enviar correo de notificacion a: ' . $solicitudAprobada->tipoUsuario($solicitudAprobada)->fullName);
                            Log::critical('Error al conectar al servidor de correo  ' . $e->getMessage());
                        }
                        if ($solicitudAprobada->tipoUsuario == 0 || $solicitudAprobada->tipoUsuario == 1) {
                            // datos de users
                            $this->solicituAprobadaAdmin($solicitudAprobada);
                        } else {
                            // datos de usuarios
                            $this->solicituAprobadaUsu($solicitudAprobada);
                        }
                    }
                } else {
                    $this->solicitudAprobada();
                }
                break;
            }
        }
        foreach ($solicitudesPendientes as $solicitudR) {
            if ($solicitudR->id != $id) {
                $solicitudRechazada  = Solicitud::find($solicitudR->id);
                $data['id']          = $solicitudRechazada->tipoUsuario($solicitudRechazada)->id;
                $data['nombre']      = $solicitudRechazada->tipoUsuario($solicitudRechazada)->nombre;
                $data['apellidoP']   = $solicitudRechazada->tipoUsuario($solicitudRechazada)->apellidoP;
                $data['email']       = $solicitudRechazada->tipoUsuario($solicitudRechazada)->email;
                $data['fechaInicio'] = $solicitudRechazada->fechaInicio;
                $data['fechaFin']    = $solicitudRechazada->fechaFin;
                $data['horaInicio']  = $solicitudRechazada->horaInicio;
                $data['horaFin']     = $solicitudRechazada->horaFin;
                $data['espacio']     = $solicitudRechazada->espacio->nombre;
                if ($solicitudRechazada->estado != 1) {
                    $solicitudRechazada->estado = 2;
                    $solicitudRechazada->motivo = 'Fechas y Horas translapadas';
                    $data['motivo']             = $solicitudRechazada->motivo;
                    if ($solicitudRechazada->save()) {
                        // notificacion
                        $this->notificacion($solicitudRechazada->id);
                        $this->debolverElementos($solicitudRechazada->id);
                        try {
                            $this->enviarEmailSolicitudRechazada($data);
                        } catch (\Exception $e) {
                            Log::notice('No se pudo enviar correo de notificacion a: ' . $solicitudAprobada->tipoUsuario($solicitudAprobada)->fullName);
                            Log::critical('Error al conectar al servidor de correo  ' . $e->getMessage());
                        }
                        if ($solicitudRechazada->tipoUsuario == 0 || $solicitudRechazada->tipoUsuario == 1) {
                            $this->solicitudRechazadaAdmin($solicitudRechazada);
                        } else {
                            $this->solicitudRechazadaUsu($solicitudRechazada);
                        }
                    }
                }
            }
        }
        return redirect('/admin');
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
            $solicitud->estado = 2;
            $solicitud->motivo = $request->motivo;
            $data['motivo']    = $solicitud->motivo;
            if ($solicitud->save()) {
                // $id = $solicitud->id;
                $this->notificacion($solicitud->id);
                $this->debolverElementos($solicitud->id);
                try {
                    $this->enviarEmailSolicitudRechazada($data);
                } catch (\Exception $e) {
                    Log::notice('No se pudo enviar correo de notificacion a: ' . $usuario->nombre . ' ' . $usuario->apellidoP);
                    Log::critical('Error al conectar al servidor de correo  ' . $e->getMessage());
                }
                if ($solicitud->tipoUsuario == 0 || $solicitud->tipoUsuario == 1) {
                    // datos de users
                    $this->solicitudRechazadaAdmin($solicitud);
                } else {
                    // datos de usuarios
                    $this->solicitudRechazadaUsu($solicitud);
                }
                return back();
            }
        }
        $this->solicitudRechazada();
        return back();
    }

    public function cancelar(Request $request, $id)
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
        if ($solicitud->estado != 3) {
            $fechaI            = $solicitud->fechaInicio->format('l j F');
            $horaI             = $solicitud->horaInicio;
            $solicitud->estado = 3;
            $solicitud->motivo = $request->motivo;
            $data['motivo']    = $solicitud->motivo;
            if ($solicitud->save()) {
                // $id = $solicitud->id;
                $this->notificacion($solicitud->id);
                $this->debolverElementos($solicitud->id);
                try {
                    $this->enviarEmailSolicitudCancelada($data);
                } catch (\Exception $e) {
                    Log::notice('No se pudo enviar correo de notificacion a: ' . $usuario->nombre . ' ' . $usuario->apellidoP);
                    Log::critical('Error al conectar al servidor de correo  ' . $e->getMessage());
                }
                if ($solicitud->tipoUsuario == 0 || $solicitud->tipoUsuario == 1) {
                    // datos de users
                    $this->solicitudCanceladaAdmin($solicitud);
                } else {
                    // datos de usuarios
                    $this->solicitudCanceladaUsu($solicitud);
                }
                return back();
            }
        }
        $this->solicitudCancelada();
        return back();
    }

    public function crearEvaluacion($id)
    {
        $solicitud                       = Solicitud::find($id);
        $evaluacion                      = new Evaluaciones;
        $evaluacion->solicitud_id        = $solicitud->id;
        $evaluacion->evaluador           = $solicitud->area->responsables->id;
        $evaluacion->evaluado            = $solicitud->solicitante->id;
        $evaluacion->tipoCuentaEvaluador = $solicitud->area->responsables->tipoCuenta;
        $evaluacion->tipoCuentaEvaluado  = $solicitud->solicitante->tipoCuenta;
        $evaluacion->estado              = 0;
        $evaluacion->save();

        $evaluacion                      = new Evaluaciones;
        $evaluacion->solicitud_id        = $solicitud->id;
        $evaluacion->evaluado            = $solicitud->area->responsables->id;
        $evaluacion->evaluador           = $solicitud->solicitante->id;
        $evaluacion->tipoCuentaEvaluado  = $solicitud->area->responsables->tipoCuenta;
        $evaluacion->tipoCuentaEvaluador = $solicitud->solicitante->tipoCuenta;
        $evaluacion->estado              = 0;
        $evaluacion->save();
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
        $data  = Solicitud::all();
        $pdf   = PDF::loadView('admins.solicitudes.pdfSolicitudes', ['data' => $data]);
        // return $pdf->stream();
        return $pdf->download('solicitudes_' . $fecha . '.pdf');
    }

    public function solicitud($id)
    {

        $fecha     = date('d-m-Y/h:i:s');
        $pdf       = App::make('dompdf.wrapper');
        $solicitud = Solicitud::find($id);
        $pdf       = PDF::loadView('admins.solicitudes.pdf', ['solicitud' => $solicitud]);
        // return $pdf->stream();
        return $pdf->download('solicitud_' . $solicitud->tipoUsuario($solicitud)->fullName . '_' . $fecha . '.pdf');
    }

    public function export()
    {
        return Excel::download(new SolicitudExport, 'solicitudes.xlsx');
    }

}

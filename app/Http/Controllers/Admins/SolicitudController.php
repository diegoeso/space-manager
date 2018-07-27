<?php

namespace App\Http\Controllers\Admins;

use App\Area;
use App\Espacio;
use App\Evaluaciones;
use App\Http\Controllers\Controller;
use App\Notificacion;
use App\Services\PayUService\Exception;
use App\Solicitud;
use App\Traits\Alertas;
use App\User;
use App\Usuario;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mail;
use Toastr;
use Yajra\DataTables\DataTables;

class SolicitudController extends Controller
{

    use Alertas;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:solicitudes.index')->only('index');
        $this->middleware('permission:solicitudes.create')->only(['create', 'store']);
        $this->middleware('permission:solicitudes.show')->only('show');
        $this->middleware('permission:solicitudes.edit')->only(['edit', 'update']);
        $this->middleware('permission:solicitudes.destroy')->only('destroy');
        $this->middleware('permission:solicitudes.aprobar')->only('aprobar');
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
    public function store(Request $request)
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
            $manyToMany = array();
            for ($i = 0; $i < count($request->cantidad); $i++) {
                $manyToMany[$request->elemento_id[$i]] = ['cantidad' => $request->cantidad[$i]];
            }
            $solicitud->elementosSolicitud()->sync($manyToMany);
            $id = $solicitud->id;
            $this->notificacion($id);
            $this->registroExitoso();
            return redirect()->route('solicitudes.index');
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
        if ($notificacion->estado == 0) {
            if (Auth::user()->tipoCuenta == 0) {
                $notificacion->estadoAdmin = 1;
            } else {
                $notificacion->estadoRes = 1;
            }
            $notificacion->save();
        }

        $solicitud   = Solicitud::find($notificacion->solicitud->id);
        $fechaInicio = date("Y-m-d", strtotime($solicitud->fechaInicio));
        $fechaFin    = date("Y-m-d", strtotime($solicitud->fechaFin));
        $horaInicio  = date("H:i:s", strtotime($solicitud->horaInicio));
        $horaFin     = date("H:i:s", strtotime($solicitud->horaFin));
        $espacio_id  = $solicitud->espacio_id;
        $estado      = $solicitud->estado;

        $total = Evaluaciones::where('estado', 1)->orderBy('evaluado')->orderBy('solicitud_id')->get();

        $bandera = null;
        if ($estado == 1 || $estado == 2 || $estado == 3) {

            $bandera = 0;
            return view('admins.solicitudes.show', compact('solicitud', 'bandera', 'total'));
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

        $solicitud   = Solicitud::find($id);
        $fechaInicio = date("Y-m-d", strtotime($solicitud->fechaInicio));
        $fechaFin    = date("Y-m-d", strtotime($solicitud->fechaFin));
        $horaInicio  = date("H:i:s", strtotime($solicitud->horaInicio));
        $horaFin     = date("H:i:s", strtotime($solicitud->horaFin));
        $espacio_id  = $solicitud->espacio_id;
        $estado      = $solicitud->estado;

        $total = Evaluaciones::where('estado', 1)->orderBy('evaluado')->orderBy('solicitud_id')->get();

        $bandera = null;
        if ($estado == 1 || $estado == 2 || $estado == 3) {
            $bandera = 0;
            return view('admins.solicitudes.show', compact('solicitud', 'bandera', 'total'));
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
            // dd($total);
            $bandera = 1;
            return view('admins.solicitudes.show', compact('solicitudesPendientes', 'bandera', 'total'));
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
            $manyToMany = array();
            for ($i = 0; $i < count($request->cantidad); $i++) {
                $manyToMany[$request->elemento_id[$i]] = ['cantidad' => $request->cantidad[$i]];
            }
            $solicitud->elementosSolicitud()->sync($manyToMany);

            $id = $solicitud->id;
            $this->notificacion($id);
            $this->registroExitoso();
            return redirect()->route('solicitudes.index');
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
        $result    = $solicitud->delete();
        if ($result) {
            return response()->json(['success' => 'true']);
        } else {
            return response()->json(['success' => 'false']);
        }
    }

    public function listarSolicitudes($id)
    {
        $solicitudes = Solicitud::where('tipoRegistro', 0)->get();
        // $solicitudes = Solicitud::all();

        return Datatables::of($solicitudes)
            ->editColumn('usuarioSolicitud', function ($solicitudes) {
                if ($solicitudes->tipoUsuario == 0 || $solicitudes->tipoUsuario == 1) {
                    return $solicitudes->solicitanteAdmin->nombre . ' ' . $solicitudes->solicitanteAdmin->apellidoP . ' ' . $solicitudes->solicitanteAdmin->apellidoM;
                } else {
                    return $solicitudes->solicitante->nombre . ' ' . $solicitudes->solicitante->apellidoP . ' ' . $solicitudes->solicitante->apellidoM;
                }
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
                return '<a href="' . route("solicitudes.show", $solicitudes->id) . '" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a> ' .
                '<a href="' . route('solicitudes.edit', $solicitudes->id) . '" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-edit"></i></a> ' .
                '<a href="#" value="' . $solicitudes->id . '" class="btn btn-danger btn-xs" id="btnEliminar"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->make(true);
    }

    public function aprobar($id)
    {
        $solicitud = Solicitud::find($id);
        // $solicitud   = Solicitud::where('id', $id);
        $fechaInicio = date("Y-m-d", strtotime($solicitud->fechaInicio));
        $fechaFin    = date("Y-m-d", strtotime($solicitud->fechaFin));
        $horaInicio  = date("H:i:s", strtotime($solicitud->horaInicio));
        $horaFin     = date("H:i:s", strtotime($solicitud->horaFin));
        $espacio_id  = $solicitud->espacio_id;
        $estado      = $solicitud->estado;

        // dd($solicitud);

        $solicitudesPendientes = Solicitud::where('fechaInicio', $fechaInicio)
            ->where('estado', $estado)
            ->where('espacio_id', $espacio_id)
            ->whereBetween('horaInicio', [$horaInicio, $horaFin])
            ->orwhereBetween('horaFin', [$horaInicio, $horaFin])
            ->where('espacio_id', $espacio_id)
            ->where('fechaInicio', $fechaInicio)
            ->where('estado', $estado)
            ->get();

        foreach ($solicitudesPendientes as $solicitud) {
            if ($solicitud->id == $id) {
                $solicitud = Solicitud::find($id);
                if ($solicitud->tipoUsuario == 0 || $solicitud->tipoUsuario == 1) {
                    $usuario = User::find($solicitud->usuarioSolicitud);
                } else {
                    $usuario = Usuario::find($solicitud->usuarioSolicitud);
                }
                $espacio             = Espacio::find($solicitud->espacio_id);
                $data['id']          = $usuario->id;
                $data['nombre']      = $usuario->nombre;
                $data['apellidoP']   = $usuario->apellidoP;
                $data['email']       = $usuario->email;
                $data['fechaInicio'] = $solicitud->fechaInicio;
                $data['fechaFin']    = $solicitud->fechaFin;
                $data['horaInicio']  = $solicitud->horaInicio;
                $data['horaFin']     = $solicitud->horaFin;
                $data['espacio']     = $espacio->nombre;
                $data['motivo']      = $solicitud->motivo;

                //que no esta aprobada aun
                if ($solicitud->estado != 1) {
                    $fechaI                     = $solicitud->fechaInicio->format('l j F');
                    $horaI                      = $solicitud->horaInicio;
                    $solicitud->estado          = 1;
                    $solicitud->aproboSolicitud = Auth::user()->id;
                    if ($solicitud->save()) {
                        $id = $solicitud->id;
                        $this->notificacion($id);
                        $this->crearEvaluacion($solicitud->id);
                        try {
                            Mail::send('mail.solicitudAprobada', $data, function ($message) use ($data) {
                                $message->from('contacto@gdsoft.com.mx', 'Space Manager');
                                $message->to($data['email'], $data['nombre']);
                                $message->subject('Solicitud');
                            });
                        } catch (\Exception $e) {
                            Log::notice('No se pudo enviar correo de notificacion a: ' . $usuario->nombre . ' ' . $usuario->apellidoP);
                            Log::critical('Error al conectar al servidor de correo  ' . $e->getMessage());
                        }

                        if ($solicitud->tipoUsuario == 0 || $solicitud->tipoUsuario == 1) {
                            // datos de users
                            $this->solicituAprobadaAdmin($solicitud);
                        } else {
                            // datos de usuarios
                            $this->solicituAprobadaUsu($solicitud);
                        }
                    }
                } else {
                    $this->solicitudAprobada();
                }
            } else {
                $solicitud = Solicitud::find($solicitud->id);
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
                    $solicitud->motivo = 'Fechas y Horas translapadas';
                    $data['motivo']    = $solicitud->motivo;
                    if ($solicitud->save()) {
                        // notificacion
                        $id = $solicitud->id;
                        $this->notificacion($id);
                        Mail::send('mail.solicitudRechazada', $data, function ($message) use ($data) {
                            $message->from('contacto@gdsoft.com.mx', 'Space Manager');
                            $message->to($data['email'], $data['nombre']);
                            $message->subject('Solicitud');
                        });
                        // Datos de users
                        if ($solicitud->tipoUsuario == 0 || $solicitud->tipoUsuario == 1) {
                            Toastr::warning('Solicitud de' . ' ' . $solicitud->solicitanteAdmin->nombre . ' ' . $solicitud->solicitanteAdmin->apellidoP . ' ' . $solicitud->solicitanteAdmin->apellidoM . '<br/>' . ' Espacio:  ' . $solicitud->espacio->nombre . '<br/>' . 'Fecha: ' . $fechaI . ' ' . $horaI . '<br/>', '¡Rechazada!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
                        } else {
                            // Datos de usuarios
                            Toastr::warning('Solicitud de' . ' ' . $solicitud->solicitante->nombre . ' ' . $solicitud->solicitante->apellidoP . ' ' . $solicitud->solicitante->apellidoM . '<br/>' . ' Espacio:  ' . $solicitud->espacio->nombre . '' . '<br/>' . 'Fecha: ' . $fechaI . ' ' . $horaI . '<br/>', '¡Rechazada!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
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
            $fechaI            = $solicitud->fechaInicio->format('l j F');
            $horaI             = $solicitud->horaInicio;
            $solicitud->estado = 2;
            $solicitud->motivo = $request->motivo;
            $data['motivo']    = $solicitud->motivo;
            if ($solicitud->save()) {
                $id = $solicitud->id;
                $this->notificacion($id);
                try {

                    Mail::send('mail.solicitudRechazada', $data, function ($message) use ($data) {
                        $message->from('contacto@gdsoft.com.mx', 'Space Manager');
                        $message->to($data['email'], $data['nombre']);
                        $message->subject('Solicitud');
                    });
                } catch (\Exception $e) {
                    Log::notice('No se pudo enviar correo de notificacion a: ' . $usuario->nombre . ' ' . $usuario->apellidoP);
                    Log::critical('Error al conectar al servidor de correo  ' . $e->getMessage());

                }

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
                $id = $solicitud->id;
                $this->notificacion($id);
                try {

                    Mail::send('mail.solicitudCancelada', $data, function ($message) use ($data) {
                        $message->from('contacto@gdsoft.com.mx', 'Space Manager');
                        $message->to($data['email'], $data['nombre']);
                        $message->subject('Solicitud');
                    });
                } catch (\Exception $e) {
                    Log::notice('No se pudo enviar correo de notificacion a: ' . $usuario->nombre . ' ' . $usuario->apellidoP);
                    Log::critical('Error al conectar al servidor de correo  ' . $e->getMessage());
                }

                if ($solicitud->tipoUsuario == 0 || $solicitud->tipoUsuario == 1) {
                    // datos de users
                    Toastr::error('Solicitud de' . ' ' . $solicitud->solicitanteAdmin->nombreCompleto . '<br/>' . ' Espacio:  ' . $solicitud->espacio->nombre . '<br/>' . 'Fecha: ' . $fechaI . ' ' . $horaI . '<br/>', '¡Cancelada!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
                } else {
                    // datos de usuarios
                    Toastr::error('Solicitud de' . ' ' . $solicitud->solicitante->nombreCompleto . '<br/>' . ' Espacio:  ' . $solicitud->espacio->nombre . '<br/>' . 'Fecha: ' . $fechaI . ' ' . $horaI . '<br/>', '¡Cancelada!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
                }
                return back();
            }
        }

        Toastr::warning('La solicitud ya ha sido cancelada', '¡Alerta!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
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
}

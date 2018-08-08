<?php

namespace App\Http\Controllers\Admins;

use App\Area;
use App\Http\Controllers\Controller;
use App\Solicitud;
use App\Traits\Alertas;
use Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CalendarioEscolarController extends Controller
{
    use Alertas;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:usuario,web');
    }
    public function index()
    {
        return view('admins.calendarioEscolar.index');
    }

    public function horarios()
    {
        return view('admins.calendarioEscolar.datatable');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::pluck('nombre', 'id');
        return view('admins.calendarioEscolar.create', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Obtener el dia de la semana de un rango de fechas
        $fechaInicio = strtotime($request->fechaI);
        $fechaFin    = strtotime($request->fechaF);
        $diaSemana   = $request->diaSemana;
        $horaInicio  = date("H:i:s", strtotime($request->horaInicio));
        $horaFin     = date("H:i:s", strtotime($request->horaFin));
        //Recorro las fechas y con la función strotime obtengo los lunes
        for ($i = $fechaInicio; $i <= $fechaFin; $i += 86400) {
            //Sacar el dia de la semana con el modificador N de la funcion date
            $dia = date('N', $i);
            if ($dia == $diaSemana) {
                $horario                     = new Solicitud;
                $horario->fechaInicio        = date("Y-m-d", $i);
                $horario->fechaFin           = date("Y-m-d", $i);
                $horario->horaInicio         = $horaInicio;
                $horario->horaFin            = $horaFin;
                $horario->actividadAcademica = $request->actividadAcademica;
                $horario->estado             = 1;
                $horario->docente            = $request->docente;
                $horario->grupo              = $request->grupo;
                $horario->semestre           = $request->semestre;
                $horario->carrera            = $request->carrera;
                $horario->background         = $request->background;
                $horario->area_id            = $request->area_id;
                $horario->espacio_id         = $request->espacio_id;
                $horario->tipoRegistro       = 1;
                $horario->usuarioSolicitud   = Auth::user()->id;
                $horario->tipoUsuario        = Auth::user()->tipoCuenta;
                $horario->save();

            }
        }
        $this->registroExitoso();
        return redirect()->route('calendarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $horario = Solicitud::find($id);
        return view('admins.calendarioEscolar.show', compact('horario'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $horario = Solicitud::find($id);
        $areas   = Area::pluck('nombre', 'id');
        return view('admins.calendarioEscolar.edit', compact('horario', 'areas'));
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
        //
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

    public function listarHorarios($id)
    {
        $calendarios = Solicitud::where('tipoRegistro', 1)->get();
        return Datatables::of($calendarios)
            ->editColumn('carrera', function ($calendarios) {
                switch ($calendarios->carrera) {
                    case '1':
                        return 'Ing. En Software';
                        break;
                    case '2':
                        return 'Lic. Seguridad Ciudadana';
                        break;
                    case '3':
                        return 'Ing. Producción Industrial';
                        break;
                    case '4':
                        return 'Ing. En Plasticos';
                        break;
                }
            })
            ->editColumn('fechaInicio', function ($calendarios) {
                return $calendarios->fechaInicio->format('l j  F');
            })
            ->editColumn('horaInicio', function ($calendarios) {
                return $calendarios->horaInicio . ' - ' . $calendarios->horaFin;
            })

            ->editColumn('espacio_id', function ($calendarios) {
                return $calendarios->espacio->nombre;
            })
            ->editColumn('semestre', function ($calendarios) {
                return $calendarios->nombreSemestre($calendarios->semestre);
            })
            ->addColumn('action', function ($calendarios) {
                return '<a href="' . route("calendarios.show", $calendarios->id) . '" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a> ' .
                '<a href="#" value="' . $calendarios->id . '" class="btn btn-danger btn-xs" id="btnEliminar"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->make(true);
    }
}

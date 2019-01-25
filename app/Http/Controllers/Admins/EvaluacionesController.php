<?php

namespace App\Http\Controllers\Admins;

use App\Evaluaciones;
use App\Http\Controllers\Controller;
use App\Traits\Alertas;
use Auth;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EvaluacionesController extends Controller
{
    use Alertas;

    public function __construct()
    {
        $this->middleware('auth:web,usuario');
        $this->middleware('completarRegistro');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 12 - Calificacion perfecta
        $evaluaciones = Evaluaciones::where('evaluado', Auth::user()->id)->where('estado', 1)->get();
        $cal1         = $evaluaciones->sum('cal1');
        $cal2         = $evaluaciones->sum('cal2');
        $cal3         = $evaluaciones->sum('cal3');
        $cal4         = $evaluaciones->sum('cal4');
        $cal5         = $evaluaciones->sum('cal5');

        if (count($evaluaciones) != 0) {
            $cont = count($evaluaciones);
        } else {
            $cont = 1;
        }
        $puntuacion = Evaluaciones::where('evaluado', Auth::user()->id)->where('estado', 1)
            ->select(DB::raw('SUM(cal1) as cal1'), DB::raw('SUM(cal2) as cal2'), DB::raw('SUM(cal3) as cal3'), DB::raw('SUM(cal4) as cal4'), DB::raw('SUM(cal5) as cal5'))->first();
        if ($cont == 0) {
            $total = ($cal1 + $cal2 + $cal3 + $cal4 + $cal5) / 5;
        } else {
            $total = ($cal1 / $cont + $cal2 / $cont + $cal3 / $cont + $cal4 / $cont + $cal5 / $cont) / 5;
        }
        return view('evaluaciones.index', compact('total', 'evaluaciones', 'puntuacion', 'cont'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $evaluacion         = Evaluaciones::find($request->idE);
        $evaluacion->cal1   = $request->cal1;
        $evaluacion->cal2   = $request->cal2;
        $evaluacion->cal3   = $request->cal3;
        $evaluacion->cal4   = $request->cal4;
        $evaluacion->cal5   = $request->cal5;
        $evaluacion->estado = 1;
        if ($evaluacion->save()) {
            $this->registroExitoso();
            return back();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    }

    public function listarEvaluaciones()
    {
        $evaluaciones = Evaluaciones::where('evaluador', Auth::user()->id)->get();
        return Datatables::of($evaluaciones)
            ->editColumn('solicitud_id', function ($evaluaciones) {
                return $evaluaciones->solicitud->espacio->nombre;
            })
            ->editColumn('evaluado', function ($evaluaciones) {
                if ($evaluaciones->tipoCuentaEvaluado == 0 || $evaluaciones->tipoCuentaEvaluado == 1) {
                    return $evaluaciones->solicitud->area->responsables->fullName;
                } else {
                    return $evaluaciones->evaluadoU->fullName;
                }
            })
            ->addColumn('fecha', function ($evaluaciones) {
                return $evaluaciones->solicitud->fechaInicio->format('l j  F') . ' - ' . $evaluaciones->solicitud->horaInicio . ' Hrs';
            })
            ->addColumn('action', function ($evaluaciones) {
                if ($evaluaciones->estado == 0) {
                    return '<button class="btn btn-info btn-xs" id="evaluar" value="' . $evaluaciones->id . '"><i class="fa fa-check-square-o"></i></button>';
                }
            })
            ->make(true);
    }
}

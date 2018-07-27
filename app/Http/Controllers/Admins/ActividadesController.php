<?php

namespace App\Http\Controllers\Admins;

use App\Actividades;
use App\Area;
use App\Http\Controllers\Controller;
use App\Traits\Alertas;
use Illuminate\Http\Request;

class ActividadesController extends Controller
{

    use Alertas;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.calendarioEscolar.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::pluck('nombre', 'id');
        return view('admins.actividades.create', compact('areas'));
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

        //Recorro las fechas y con la función strotime obtengo los lunes
        for ($i = $fechaInicio; $i <= $fechaFin; $i += 86400) {
            //Sacar el dia de la semana con el modificador N de la funcion date
            $dia = date('N', $i);
            if ($dia == $diaSemana) {

                // echo date('Y-m-d   ' . '<br/>', $i);
                $actividad                     = new Actividades;
                $actividad->fecha              = date("Y-m-d", $i);
                $actividad->horaInicio         = $request->horaInicio;
                $actividad->horaFin            = $request->horaFin;
                $actividad->actividadAcademica = $request->actividadAcademica;
                $actividad->estado             = 1;
                $actividad->docente            = $request->docente;
                $actividad->grupo              = $request->grupo;
                $actividad->semestre           = $request->semestre;
                $actividad->carrera            = $request->carrera;
                $actividad->area_id            = $request->area_id;
                $actividad->espacio_id         = $request->espacio_id;
                $actividad->tipoRegistro       = 1;
                $actividad->save();

            }
        }
        $this->registroExitoso();
        return redirect()->route('actividades.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        //
    }

}

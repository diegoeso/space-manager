<?php

namespace App\Http\Controllers\Admins;

use App\Elemento;
use App\Espacio;
use App\Http\Controllers\Controller;
use App\Solicitud;
use Auth;
use Carbon\Carbon;
use DB;

class AJAXController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:usuario,web');
    }
    // Espacios

    public function elementos($idCategoria)
    {
        return Elemento::where('categoria_id', $idCategoria)->
            get();
    }

    public function categorias()
    {
        return DB::table('categoria_elementos')->get();
    }

    public function detallesEspacio($id)
    {
        return DB::table('elemento_espacio')
            ->join('elementos', 'elementos.id', '=', 'elemento_espacio.elemento_id')
            ->join('categoria_elementos', 'categoria_elementos.id', '=', 'elementos.categoria_id')
            ->select('elemento_espacio.*', 'elementos.id as idE', 'elementos.nombre as nombreE', 'categoria_elementos.id as idC', 'categoria_elementos.nombre as nombreC')
            ->where('espacio_id', $id)
            ->get();
    }
    // fin de espacios

    //Solicitudes
    public function espacios($idA)
    {
        return Espacio::where('area_id', $idA)->get();
    }

    public function infoEspacio($id)
    {
        return Espacio::find($id);
    }

    public function elementosEspacio($id)
    {
        $elementos = DB::table('elemento_espacio')
            ->join('elementos', 'elementos.id', '=', 'elemento_espacio.elemento_id')
            ->select('elementos.nombre', 'elemento_espacio.cantidad')
            ->where('espacio_id', $id)->get();
        return $elementos;
    }

    public function detallesSolicitud($id)
    {
        return DB::table('elemento_solicitud')
            ->join('elementos', 'elementos.id', '=', 'elemento_solicitud.elemento_id')
            ->join('categoria_elementos', 'categoria_elementos.id', '=', 'elementos.categoria_id')
            ->select('elemento_solicitud.*', 'elementos.id as idE', 'elementos.nombre as nombreE', 'categoria_elementos.id as idC', 'categoria_elementos.nombre as nombreC', 'elementos.existencias as existencias')
            ->where('solicitud_id', $id)
            ->get();
    }

    public function existenciasElementos($id)
    {
        return Elemento::find($id);
    }

    public function solicitudesFullCalendar($estado)
    {
        $now             = Carbon::now();
        $fechaActual     = $now->format('Y-m-d');
        $calendar        = Solicitud::where('tipoRegistro', 0)->get();
        $data            = [];
        $backgroundColor = '';
        $borderColor     = '';
        foreach ($calendar as $event) {
            // colores para cada estado de la solicitud
            switch ($event->estado) {
                case '1':
                    $backgroundColor = '#00a65a';
                    $borderColor     = '#00a65a';
                    break;
                case '2':
                    $backgroundColor = '#f39c12';
                    $borderColor     = '#f39c12';
                    break;
                case '3':
                    $backgroundColor = '#f56954';
                    $borderColor     = '#f56954';
                    break;
                case '4':
                    $backgroundColor = '#d2d6de';
                    $borderColor     = '#d2d6de';
                    break;
                default:
                    $backgroundColor = '#00c0ef';
                    $borderColor     = '#00c0ef';
                    break;
            }
            $subArr = [
                'id'               => $event->id,
                'title'            => $event->espacio->nombre,
                'start'            => $event->fechaInicio->format('Y-m-d') . ' ' . $event->horaInicio,
                'end'              => $event->fechaFin->format('Y-m-d') . ' ' . $event->horaFin,
                'url'              => route('solicitudes.show', $event->id),
                'backgroundColor'  => $backgroundColor,
                'borderColor'      => $borderColor,
                'resourceEditable' => false,
            ];
            array_push($data, $subArr);
        }
        return $data;
    }

    public function solicitudesFullCalendarUsuarios($carrera)
    {
        $now               = Carbon::now();
        $fechaActual       = $now->format('Y-m-d');
        $calendar          = Solicitud::where('estado', 1)->where('tipoRegistro', 0)->get();
        $calendarUsuario   = Solicitud::where('estado', 0)->where('usuarioSolicitud', Auth::user()->id)->get();
        $calendarioEscolar = Solicitud::where('carrera', 'like', '%' . $carrera . '%')->where('estado', 1)->where('tipoRegistro', 1)->orderBy('id', 'ASC')->get();
        $data              = [];
        $backgroundColor   = '';
        $borderColor       = '';
        foreach ($calendar as $event) {
            // colores para cada estado de la solicitud
            switch ($event->estado) {
                case '1':
                    $backgroundColor = '#00a65a';
                    $borderColor     = '#00a65a';
                    break;
                case '2':
                    $backgroundColor = '#f39c12';
                    $borderColor     = '#f39c12';
                    break;
                case '3':
                    $backgroundColor = '#f56954';
                    $borderColor     = '#f56954';
                    break;
                case '4':
                    $backgroundColor = '#d2d6de';
                    $borderColor     = '#d2d6de';
                    break;
                default:
                    $backgroundColor = '#00c0ef';
                    $borderColor     = '#00c0ef';
                    break;
            }
            $subArr = [
                'id'              => $event->id,
                'title'           => $event->espacio->nombre,
                'start'           => $event->fechaInicio->format('Y-m-d') . ' ' . $event->horaInicio,
                'end'             => $event->fechaFin->format('Y-m-d') . ' ' . $event->horaFin,
                'backgroundColor' => $backgroundColor,
                'borderColor'     => $borderColor,
            ];
            array_push($data, $subArr);
        }

        foreach ($calendarUsuario as $event) {
            $subArr = [
                'id'              => $event->id,
                'title'           => $event->espacio->nombre . ' - ' . $event->solicitante->nombre . ' ' . $event->solicitante->apellidoP,
                'start'           => $event->fechaInicio->format('Y-m-d') . ' ' . $event->horaInicio,
                'end'             => $event->fechaFin->format('Y-m-d') . ' ' . $event->horaFin,
                'url'             => route('solicitud.show', $event->id),
                'backgroundColor' => '#00c0ef',
                'borderColor'     => '#00c0ef',
            ];
            array_push($data, $subArr);
        }

        foreach ($calendarioEscolar as $event) {
            $subArr = [
                'id'              => $event->id,
                'title'           => $event->espacio->nombre . ' - ' . $event->docente . '   -   ' . $event->actividadAcademica . '    ' . 'Grupo: ' . $event->grupo,
                'start'           => $event->fechaInicio->format('Y-m-d') . ' ' . $event->horaInicio,
                'end'             => $event->fechaFin->format('Y-m-d') . ' ' . $event->horaFin,
                'backgroundColor' => $event->background,
                'borderColor'     => $event->background,
            ];
            array_push($data, $subArr);
        }

        return $data;
    }

    // actividades Academicas
    public function calendarioEscolar($carrera)
    {
        $calendarioEscolar = Solicitud::where('carrera', $carrera)->where('tipoRegistro', 1)->get();
        $data              = [];
        $backgroundColor   = '';
        $borderColor       = '';
        foreach ($calendarioEscolar as $event) {
            $subArr = [
                'id'              => $event->id,
                'title'           => $event->espacio->nombre . ' - ' . $event->docente . '   -   ' . $event->actividadAcademica . '    ' . 'Grupo: ' . $event->grupo,
                'start'           => $event->fechaInicio->format('Y-m-d') . ' ' . $event->horaInicio,
                'end'             => $event->fechaFin->format('Y-m-d') . ' ' . $event->horaFin,
                'backgroundColor' => $event->background,
                'borderColor'     => $event->background,
            ];
            array_push($data, $subArr);
        }
        return $data;
    }

    public function mostrarSolicitud($id)
    {
        $solicitud = Solicitud::find($id);
        if ($solicitud->tipoUsuario == 0 || $solicitud->tipoUsuario == 1) {
            return Solicitud::with('solicitanteAdmin')->with('espacio')->where('id', $id)->first();
        } else {
            return Solicitud::with('solicitante')->with('espacio')->where('id', $id)->first();
        }
    }

    // Actualizar elementos al eliminar elemento de solicitud
    public function editarElemento($id, $cantidad)
    {
        $elemento              = Elemento::FindOrFail($id);
        $elemento->existencias = $elemento->existencias + intval($cantidad);
        $result                = $elemento->save();
        if ($result) {
            return response()->json(['success' => 'true']);
        } else {
            return response()->json(['success' => 'false']);
        }
    }

    public function solicitudesGrafica()
    {
        // $solicitudesG = Solicitud::select(DB::raw('count(*) as total, espacio_id'))->where('tipoRegistro', 0)->groupBy('espacio_id')->get();
        $solicitudesG = DB::table('solicitudes')
            ->join('espacios', 'espacios.id', '=', 'solicitudes.espacio_id')
            ->select('espacios.nombre', DB::raw('count(*) as total'))
            ->groupBy('espacios.nombre', 'solicitudes.espacio_id')
            ->orderBy('total', 'DESC')
            ->get();
        return $solicitudesG;
    }

}

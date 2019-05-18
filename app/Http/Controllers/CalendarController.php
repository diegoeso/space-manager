<?php

namespace App\Http\Controllers;

use App\Solicitud;

class CalendarController extends Controller
{
    public function welcome_calendar($carrera)
    {
        $calendar = Solicitud::where('estado', 1)
            ->where('tipoRegistro', 0)
            ->get();
        $calendarioEscolar = Solicitud::where('carrera', $carrera)
            ->where('tipoRegistro', 1)
            ->orderBy('fechaInicio', 'ACS')
            ->get();
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
                'id'              => $event->id,
                'title'           => $event->espacio->nombre,
                'start'           => $event->fechaInicio->format('Y-m-d') . ' ' . $event->horaInicio,
                'end'             => $event->fechaFin->format('Y-m-d') . ' ' . $event->horaFin,
                'backgroundColor' => $backgroundColor,
                'borderColor'     => $borderColor,
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

    public function mostrar_evento($id)
    {
        $solicitud = Solicitud::find($id);
        if ($solicitud->tipoUsuario == 0 || $solicitud->tipoUsuario == 1) {
            return Solicitud::with('solicitanteAdmin')->with('espacio')->where('id', $id)->first();
        } else {
            return Solicitud::with('solicitante')->with('espacio')->where('id', $id)->first();
        }
    }
}

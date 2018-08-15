<?php

namespace App\Console\Commands;

use App\Elemento;
use App\Solicitud;
use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CancelarSolicitud extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cancelar:solicitud';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancelar solicitudes que no fueron aprobadas y el tiempo de inicio ya paso';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now         = Carbon::now();
        $fecha       = $now->format('Y-m-d');
        $hora        = $now->format('H:i:s');
        $nuevaFecha  = strtotime('-1 minute', strtotime($hora));
        $nuevaFecha2 = strtotime('+1 minute', strtotime($hora));
        $hora2       = date('H:i:s', $nuevaFecha);
        $hora3       = date('H:i:s', $nuevaFecha2);
        $solicitudes = Solicitud::where('fechaInicio', '=', $fecha)
            ->whereBetween('horaInicio', [$hora2, $hora3])
            ->where('estado', 0)
            ->get();

        if (count($solicitudes) != 0) {
            Log::info(count($solicitudes) . '   Solicitudes Canceladas');
        }
        $solicitudesCanceladas = Solicitud::where('fechaInicio', '=', $fecha)
            ->whereBetween('horaInicio', [$hora2, $hora3])
            ->where('estado', 0)->update(['estado' => 3, 'motivo' => 'El tiempo para aprobar la solicitud a rebasado la hora de inicio de la actividad académica']);
        foreach ($solicitudes as $solicitud) {
            $elementosSolicitados = DB::table('elemento_solicitud')->where('solicitud_id', $solicitud->id)->get();
            foreach ($elementosSolicitados as $el) {
                $elemento              = Elemento::find($el->elemento_id);
                $solicitados           = DB::table('elemento_solicitud')->where('elemento_id', $el->elemento_id)->first();
                $elemento->existencias = $elemento->existencias + $solicitados->cantidad;
                $elemento->save();
            }
            DB::table('elemento_solicitud')->where('solicitud_id', $solicitud->id)->delete();
            Log::notice('Se regresaron los elementos solicitados');
        }
    }
}

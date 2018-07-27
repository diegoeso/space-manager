<?php

namespace App\Console\Commands;

use App\Solicitud;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FinalizaSolicitud extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'finaliza:solicitud';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cambio de estado a las solicitudes que ya se han llevado acabo para ponerlas como actividades finalizadas.';

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
            ->whereBetween('horaFin', [$hora2, $hora3])
            ->where('estado', 1)
            ->get();
        if (count($solicitudes) != 0) {
            Log::info(count($solicitudes) . '   Solicitudes Finalizadas');
        }
        $solicitudes = Solicitud::where('fechaInicio', '=', $fecha)
            ->whereBetween('horaFin', [$hora2, $hora3])
            ->where('estado', 1)->update(['estado' => 4]);

    }
}

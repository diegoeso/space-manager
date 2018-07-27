<?php

namespace App\Console\Commands;

use App\Solicitud;
use Carbon\Carbon;
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
        $now       = Carbon::now();
        $fecha     = $now->format('Y-m-d');
        $hora      = $now->format('H:i:s');
        $solicitud = Solicitud::where('fechaInicio', '=', $fecha)
            ->where('horaFin', '<', $hora)
            ->where('estado', 0)->get();
        if (count($solicitud) != 0) {
            Log::info(count($solicitud) . '  Solicitudes Canceladas');
        }
        $solicitudes = Solicitud::where('fechaInicio', '=', $fecha)
            ->where('horaFin', '<', $hora)
            ->where('estado', 0)
            ->update(['estado' => 3, 'motivo' => 'La hora de inicio es menor que la hora actual.']);

    }
}

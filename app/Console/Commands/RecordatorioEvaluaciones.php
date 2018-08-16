<?php

namespace App\Console\Commands;

use App\Evaluaciones;
use App\Services\PayUService\Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Mail;

class RecordatorioEvaluaciones extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifica:evaluaciones';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifica al usuario si tiene evaluaciones pendientes por realizar.';

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

        $evaluaciones = Evaluaciones::where('estado', 0)
            ->groupBy('evaluador')
            ->orderBy('id', 'DESC')
            ->get();

        foreach ($evaluaciones as $evaluacion) {
            $data['id']     = $evaluacion->tipoCuentaEvaluado($evaluacion)->id;
            $data['nombre'] = $evaluacion->tipoCuentaEvaluado($evaluacion)->fullName;
            $data['email']  = $evaluacion->tipoCuentaEvaluado($evaluacion)->email;
            try {
                Mail::send('mail.evaluacionesPendientes', $data, function ($message) use ($data) {
                    $message->from('contacto@gdsoft.com.mx', 'Space Manager');
                    $message->to($data['email'], $data['nombre']);
                    $message->subject('Evaluaciones Pendientes');
                });

            } catch (\Exception $e) {
                Log::notice('No se pudo enviar correo de notificacion a: ' . $data['nombre']);
                Log::critical('Error al conectar al servidor de correo  ' . $e->getMessage());
            }

        }
        Log::info('Se notificaron evaluaciones pendientes a los usuarios');
    }
}

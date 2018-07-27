<?php

namespace App\Console\Commands;

use App\Espacio;
use App\Solicitud;
use App\User;
use App\Usuario;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Mail;

class NotificarSolicitud extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifica:solicitud';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notificar al usuario solicitante el inicio de su actividad 15 min antes de iniciar dicha actividad';

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
        $nuevaFecha  = strtotime('+14 minute', strtotime($hora));
        $nuevaFecha2 = strtotime('+16 minute', strtotime($hora));
        $hora2       = date('H:i:s', $nuevaFecha);
        $hora3       = date('H:i:s', $nuevaFecha2);
        $solicitudes = Solicitud::where('fechaInicio', '=', $fecha)
            ->whereBetween('horaInicio', [$hora2, $hora3])
            ->where('estado', 1)
            ->get();
        foreach ($solicitudes as $solicitud) {
            $solicitud = Solicitud::find($solicitud->id);
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
            $data['foto']        = $usuario->foto;
            $data['fechaInicio'] = $solicitud->fechaInicio;
            $data['fechaFin']    = $solicitud->fechaFin;
            $data['horaInicio']  = $solicitud->horaInicio;
            $data['horaFin']     = $solicitud->horaFin;
            $data['espacio']     = $espacio->nombre;

            //que no esta aprobada aun
            Mail::send('mail.notificacionSolicitud', $data, function ($message) use ($data) {
                $message->from('contacto@gdsoft.com.mx', 'Space Manager');
                $message->to($data['email'], $data['nombre']);
                $message->subject('Solicitud');
            });
            if ($solicitud->tipoUsuario == 0 || $solicitud->tipoUsuario == 1) {
                Log::info('Solicitud notificada  ' . $solicitud->solicitanteAdmin->nombreCompleto);
            } else {
                Log::info('Solicitud notificada  ' . $solicitud->solicitante->nombreCompleto);
            }

        }

    }
}

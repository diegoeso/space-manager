<?php
namespace App\Traits;

use Mail;
trait Email
{
    public function enviarEmailSolicitudAprobada($data)
    {
        Mail::send('mail.solicitudAprobada', $data, function ($message) use ($data) {
            $message->from('contacto@gdsoft.com.mx', 'Space Manager');
            $message->to($data['email'], $data['nombre']);
            $message->subject('Solicitud');
        });
    }

    public function enviarEmailSolicitudRechazada($data)
    {
        Mail::send('mail.solicitudRechazada', $data, function ($message) use ($data) {
            $message->from('contacto@gdsoft.com.mx', 'Space Manager');
            $message->to($data['email'], $data['nombre']);
            $message->subject('Solicitud');
        });
    }

    public function enviarEmailSolicitudCancelada($data)
    {
        Mail::send('mail.solicitudCancelada', $data, function ($message) use ($data) {
            $message->from('contacto@gdsoft.com.mx', 'Space Manager');
            $message->to($data['email'], $data['nombre']);
            $message->subject('Solicitud');
        });
    }
}

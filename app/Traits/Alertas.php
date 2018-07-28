<?php
namespace App\Traits;

use Toastr;
trait Alertas
{
    public function registroExitoso()
    {
        return Toastr::success('¡Registro exitoso!', '¡Hecho!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
    }

    public function registroError()
    {
        return Toastr::error('¡Error al realizar el registro!', '¡Error!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
    }

    public function registroEliminado()
    {
        return Toastr::success('¡Eliminacion exitosa!', '¡Hecho!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
    }

    public function mensajeExitoso()
    {
        return Toastr::info('¡Mensaje envido exitosamente!', '¡Enviado!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
    }

    public function mensajeError()
    {
        return Toastr::danger('¡No se pudo enviar el mensaje!', '¡Error!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
    }

    public function solicitudExistente()
    {
        return Toastr::error('¡Ya hay una actividad programana en este espacio, fecha y hora!', '¡Error!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true', "showDuration" => "6000"]);
    }

    public function solicituAprobadaAdmin($solicitud)
    {
        return Toastr::success('Solicitud de' . ' ' . $solicitud->solicitanteAdmin->nombreCompleto . '<br/>' . ' Espacio:  ' . $solicitud->espacio->nombre . '<br/>' . 'Fecha: ' . $solicitud->fechaInicio->format('l j F') . ' ' . $solicitud->horaInicio . '<br/>', '¡Aprobada!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
    }

    public function solicituAprobadaUsu($solicitud)
    {
        return Toastr::success('Solicitud de' . ' ' . $solicitud->solicitante->nombreCompleto . '<br/>' . ' Espacio:  ' . $solicitud->espacio->nombre . '<br/>' . 'Fecha: ' . $solicitud->fechaInicio->format('l j F') . ' ' . $solicitud->horaInicio . '<br/>', '¡Aprobada!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
    }

    public function solicitudRechazadaAdmin($solicitud)
    {
        Toastr::warning('Solicitud de' . ' ' . $solicitud->solicitanteAdmin->nombre . ' ' . $solicitud->solicitanteAdmin->apellidoP . ' ' . $solicitud->solicitanteAdmin->apellidoM . '<br/>' . ' Espacio:  ' . $solicitud->espacio->nombre . '<br/>' . 'Fecha: ' . $solicitud->fechaInicio->format('l j F') . ' ' . $solicitud->horaInicio . '<br/>', '¡Rechazada!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
    }
    public function solicitudRechazadaUsu($solicitud)
    {
        Toastr::warning('Solicitud de' . ' ' . $solicitud->solicitante->nombre . ' ' . $solicitud->solicitante->apellidoP . ' ' . $solicitud->solicitante->apellidoM . '<br/>' . ' Espacio:  ' . $solicitud->espacio->nombre . '' . '<br/>' . 'Fecha: ' . $solicitud->fechaInicio->format('l j F') . ' ' . $solicitud->horaInicio . '<br/>', '¡Rechazada!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
    }

    public function solicitudCanceladaAdmin($solicitud)
    {
        Toastr::error('Solicitud de' . ' ' . $solicitud->solicitanteAdmin->nombreCompleto . '<br/>' . ' Espacio:  ' . $solicitud->espacio->nombre . '<br/>' . 'Fecha: ' . $fechaI . ' ' . $horaI . '<br/>', '¡Cancelada!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
    }

    public function solicitudCanceladaUsu($solicitud)
    {
        Toastr::error('Solicitud de' . ' ' . $solicitud->solicitante->nombreCompleto . '<br/>' . ' Espacio:  ' . $solicitud->espacio->nombre . '<br/>' . 'Fecha: ' . $fechaI . ' ' . $horaI . '<br/>', '¡Cancelada!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
    }

    public function solicitudAprobada()
    {
        return Toastr::success('¡Esta solicitud ya ha sido aprobada!', '¡Aprobada!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
    }

    public function solicitudRechazada()
    {
        Toastr::warning('La solicitud ya ha sido rechazada', '¡Alerta!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
    }

    public function solicitudCancelada()
    {
        Toastr::warning('La solicitud ya ha sido cancelada', '¡Alerta!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
        return back();
    }
}

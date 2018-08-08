<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
        <title>
            Space Manager
        </title>
        <link href="css/style.css" rel="stylesheet">
        </link>
    </head>
    <body>
        <img height="80%" src="img/uaemex_banner.png" style="padding-top: 0; padding-bottom: 0; margin: 0" width="70%">
        </img>
        <h3 class="text-center" style="padding: 0; margin: 0">
            Unidad Académica Profesional Tianguistenco
        </h3>
        <h4 class="text-center">
            Información de la solicitud
        </h4>
        <br/>
        <div class="row">
            <table class="table text-center">
                <tr class="">
                    <td style="border: inset 0pt">
                        <div class="col-md-12">
                            <dt>
                                Nombre del solicitante:
                            </dt>
                            <dd class="lead">
                                {{ $solicitud->tipoUsuario($solicitud)->fullName}}
                            </dd>
                        </div>
                    </td>
                    <td style="border: inset 0pt">
                        <div class="col-md-12">
                            <dt>
                                Espacio académico solicitado:
                            </dt>
                            <dd class="lead">
                                {{ $solicitud->espacio->nombre .' / '.$solicitud->area->nombre}}
                            </dd>
                        </div>
                    </td>
                </tr>
                @if ($solicitud->tipoUsuario==2 || $solicitud->tipoUsuario==3)
                <tr>
                    <td style="border: inset 0pt">
                        <dt>
                            Carrera:
                        </dt>
                        <dd class="lead">
                            {{ $solicitud->tipoUsuario($solicitud)->nombreCarrera($solicitud->tipoUsuario($solicitud)->carrera)}}
                        </dd>
                        <dt>
                            Semestre:
                        </dt>
                        <dd class="lead">
                            {{ $solicitud->tipoUsuario($solicitud)->nombreSemestre($solicitud->tipoUsuario($solicitud)->semestre)}}
                        </dd>
                    </td>
                    <td style="border: inset 0pt">
                        <dt>
                            No. de Cuenta:
                        </dt>
                        <dd class="lead">
                            {{ $solicitud->tipoUsuario($solicitud)->matricula}}
                        </dd>
                    </td>
                </tr>
                @endif
                <tr>
                    <td style="border: inset 0pt">
                        <div class="col-md-6">
                            <dt>
                                Fecha solicitada:
                            </dt>
                            <dd class="lead">
                                {{ $solicitud->fechaInicio->format('l j F Y')}}
                            </dd>
                        </div>
                    </td>
                    <td style="border: inset 0pt">
                        <div class="col-md-6">
                            <dt>
                                Horario solicitado:
                            </dt>
                            <dd class="lead">
                                {{ $solicitud->horaInicio .' a '. $solicitud->horaFin}}
                            </dd>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border: inset 0pt;">
                        <div class="col-md-8">
                            <dt>
                                Actividad académica:
                            </dt>
                            <dd class="lead">
                                {{ $solicitud->actividadAcademica}}
                            </dd>
                        </div>
                    </td>
                    <td style="border: inset 0pt;">
                        <div class="col-md-4">
                            <dt>
                                Asistentes estimados:
                            </dt>
                            <dd class="lead">
                                {{ $solicitud->asistentesEstimados}}
                            </dd>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border: inset 0pt;">
                        <div class="col-md-8">
                            <dt>
                                Aprobó solicitud:
                            </dt>
                            <dd class="lead">
                                @if ($solicitud->aproboSolicitud)
                                    {{ $solicitud->aproboSolicitud($solicitud->aproboSolicitud)->fullName}}
                                @endif
                            </dd>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="col-md-12">
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <div class="user-block lead text-center">
                            Elementos Solicitados Adicionalmente
                        </div>
                    </div>
                    <div class="box-body">
                        @foreach ($solicitud->elementosSolicitud as $elemento)
                        <table class="table text-center">
                            <tr>
                                <td>
                                    <dt>
                                        Categoría:
                                    </dt>
                                    <dd class="lead">
                                        {{ $elemento->categoriaElemento->nombre }}
                                    </dd>
                                </td>
                                <td>
                                    <dt>
                                        Elemento:
                                    </dt>
                                    <dd class="lead">
                                        {{ $elemento->nombre }}
                                    </dd>
                                </td>
                                <td>
                                    <dt>
                                        Cantidad:
                                    </dt>
                                    <dd class="lead">
                                        {{ $elemento->pivot->cantidad }} piezas
                                    </dd>
                                </td>
                            </tr>
                        </table>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

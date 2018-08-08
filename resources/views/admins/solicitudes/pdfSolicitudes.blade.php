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
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Solicitante
                    </th>
                    <th>
                        Espacio Solicitado
                    </th>
                    <th>
                        Area
                    </th>
                    <th>
                        Fecha Solicitada
                    </th>
                    <th>
                        Horario
                    </th>
                    <th class="text-right">
                        Estado
                    </th>
                </tr>
                <tbody>
                    @foreach ($data as $solicitud)
                    <tr>
                        <td>
                            {{ $solicitud->id }}
                        </td>
                        <td>
                            {{ $solicitud->tipoUsuario($solicitud)->fullName }}
                        </td>
                        <td>
                            {{ $solicitud->espacio->nombre }}
                        </td>
                        <td>
                            {{ $solicitud->area->nombre }}
                        </td>
                        <td>
                            {{ $solicitud->fechaInicio->format('l j F Y') }}
                        </td>
                        <td>
                            {{ $solicitud->horaInicio }}
                            <br/>
                            {{ $solicitud->horaFin }}
                        </td>
                        <th>
                            @switch($solicitud->estado)
                                @case(0)
                            <span class="label label-info pull-right">
                                Pendiente
                            </span>
                            @break
                                @case(1)
                            <span class="label label-success pull-right">
                                Aceptada
                            </span>
                            @break
                                @case(2)
                            <span class="label label-warning pull-right">
                                Rechazada
                            </span>
                            @break
                                @case(3)
                            <span class="label label-danger pull-right">
                                Cancelada
                            </span>
                            @break
                                @case(4)
                            <span class="label pull-right" style="background-color:#d2d6de ">
                                Finalizada
                            </span>
                            @break
                            @endswitch
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </thead>
        </table>
    </body>
</html>

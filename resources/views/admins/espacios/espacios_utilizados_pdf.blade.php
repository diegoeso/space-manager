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
        {{--
        <img height="80%" src="img/uaemex_banner.png" style="padding-top: 0; padding-bottom: 0; margin: 0" width="70%">
        </img>
        --}}
        <h3 class="text-center" style="padding: 0; margin: 0">
            Unidad Académica Profesional Tianguistenco
        </h3>
        <h4 class="text-center">
            Espacios academicos más utilizados.
        </h4>
        <table class="table table-hover table-striped" id="espacios-table">
            <thead>
                <tr>
                    <th width="10">
                        #
                    </th>
                    <th>
                        Solicitante
                    </th>
                    <th>
                        Usuario
                    </th>
                    <th>
                        Espacio Solicitado
                    </th>
                    <th>
                        Fecha de Actividad
                    </th>
                    <th>
                        Hora de Actividad
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($espacios as $index=>$espacio)
                <tr>
                    <td>
                        {{ $index+=1 }}
                    </td>
                    <td>
                        {{ $espacio->nombreUsuarioSolicitante($espacio) }}
                    </td>
                    <td>
                        @switch($espacio->tipoUsuario)
                            @case (0)
                                Administrador
                                @break;
                            @case (1)
                                Responsable de Area
                                @break;
                            @case (2)
                                Profesor
                                @break;
                            @case (3)
                                Alumno
                                @break;
                            @default
                                Usuario
                                @break;
                        @endswitch
                    </td>
                    <td>
                        {{ $espacio->espacio->nombre }}
                    </td>
                    <td>
                        {{ $espacio->fechaInicio->format('l j F') }}
                    </td>
                    <td>
                        {{ $espacio->horaInicio }} a {{ $espacio->horaFin }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>

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
            Espacios Académicos
        </h4>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Nombre
                    </th>
                    <th>
                        Área
                    </th>
                    <th>
                        Ubicación
                    </th>
                    <th>
                        Descripción
                    </th>
                </tr>
                <tbody>
                    @foreach ($data as $espacio)
                    <tr>
                        <td>
                            {{ $espacio->id }}
                        </td>
                        <td>
                            {{ $espacio->nombre }}
                        </td>
                        <td>
                            {{ $espacio->area->nombre }}
                        </td>
                        <td>
                            {{ $espacio->ubicacion }}
                        </td>
                        <th>
                            {{ $espacio->descripcion }}
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </thead>
        </table>
    </body>
</html>

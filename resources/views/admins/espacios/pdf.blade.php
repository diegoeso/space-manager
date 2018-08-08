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

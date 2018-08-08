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
                        Descripción
                    </th>
                </tr>
                <tbody>
                    @foreach ($data as $elemento)
                    <tr>
                        <td>
                            {{ $elemento->id }}
                        </td>
                        <td>
                            {{ $elemento->nombre }}
                        </td>
                        <td>
                            {{ $elemento->descripcion }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </thead>
        </table>
    </body>
</html>

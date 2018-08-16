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
            Características de elementos
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
                        Descripción
                    </th>
                </tr>
                <tbody>
                    @foreach ($data as $categoria)
                    <tr>
                        <td>
                            {{ $categoria->id }}
                        </td>
                        <td>
                            {{ $categoria->nombre }}
                        </td>
                        <td>
                            {{ $categoria->descripcion }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </thead>
        </table>
    </body>
</html>

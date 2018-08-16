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
            Administradores
        </h4>
        <br/>
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
                        Tipo de Usuario
                    </th>
                    <th>
                        Correo
                    </th>
                    <th>
                        Teléfono
                    </th>
                </tr>
                <tbody>
                    @foreach ($data as $user)
                    <tr>
                        <td>
                            {{ $user->id }}
                        </td>
                        <td>
                            {{ $user->nombre }}
                        </td>
                        <td>
                            {{ $user->tipoCuenta($user->tipoCuenta) }}
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            {{ $user->telefono }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </thead>
        </table>
    </body>
</html>

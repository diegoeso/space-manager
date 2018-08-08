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
                        Responsable
                    </th>
                    <th>
                        Descripción
                    </th>
                    
                </tr>
                <tbody>
                    @foreach ($data as $area)
                    <tr>
                        <td>
                            {{ $area->id }}
                        </td>
                        <td>
                            {{ $area->nombre }}
                        </td>
                        <td>
                            {{ $area->responsables->fullName }}
                        </td>
                        <td>
                            {{ $area->descripcion }}
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </thead>
        </table>
    </body>
</html>

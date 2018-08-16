<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>
            Evaluaciones Pendientes
        </title>
        @include('layouts.links')
    </head>
    <body>
        <div style="background-color: rgba(215,216,219,.2)">
            <h1 class="text-center" style="padding-top: 20px; padding-bottom: 20px; color: rgba(140,139,143,.7); font-size: 48px">
                Space Manager
            </h1>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2>
                        ¡Hola {{ $nombre }}!
                    </h2>
                    <p class="lead">
                        Usted está recibiendo este correo electrónico porque notificarle que tiene evaluaciones pendientes, lo cual solicitamos realice dichas evaluaciones para tener mejor control y experiencia en nuestro sistema
                        <em>
                            Space Manager
                        </em>
                        .
                    </p>
                    <div class="text-center" style="padding-top: 40px;">
                        <a class="btn btn-info" href="{{ route('evaluaciones.index') }}">
                            Realizar Evaluaciones
                        </a>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <p class="lead">
                        Gracias por la atención.
                    </p>
                    <h3>
                        Saludos,
                    </h3>
                    <p class="lead">
                        Space Manager
                    </p>
                    <hr>
                    </hr>
                </div>
            </div>
        </div>
        @include('layouts.scripts')
    </body>
</html>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>
            Solicitud
        </title>
        @include('layouts.links')
    </head>
    <body>
        <div class="container">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-primary">
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{ asset('img/user.png') }}" width="100">
                        </img>
                    </div>
                    <h3 class="widget-user-username text-capitalize">
                        {{ $nombre .' '.$apellidoP}}
                    </h3>
                </div>
                <div class="box-footer no-padding">
                    <h3>
                        Space Manager
                    </h3>
                    <p class="lead">
                        Hola
                        <strong class="text-capitalize">
                            {{ $nombre }}
                        </strong>
                        tu solicitud para el uso del espacio
                        <strong>
                            <em>
                                {{ $espacio }}
                            </em>
                        </strong>
                        para el dia
                        <strong>
                            {{ $fechaInicio->format('l j F') }}
                        </strong>
                        a las
                        <strong>
                            {{ $horaInicio }}
                        </strong>
                        ha sido cancelada por el siguiente motivo:
                        <br/>
                        <br/>
                        <em class="text-justify">
                            {{ $motivo }}
                        </em>
                    </p>
                    <br/>
                    <p class="lead text-center">
                        Al finalizar tu actividad no olvides evaluar al responsable de area para tener un control sobre la atencion a las solicitudes de nuestra comunidad universitaria.
                        <br/>
                        <strong>
                            Equipo de ¡Space Manager!
                        </strong>
                    </p>
                </div>
            </div>
        </div>
        @include('layouts.scripts')
    </body>
</html>
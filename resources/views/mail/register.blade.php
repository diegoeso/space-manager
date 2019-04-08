<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>
            Confirmacion
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
                        {{ $nombre }}
                    </h3>
                    <h5 class="widget-user-desc text-uppercase">
                        @if ($tipoCuenta==2)
                            Profesor
                        @elseif($tipoCuenta==3)
                            Alumno
                        @endif
                    </h5>
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
                        bienvenido a
                        <strong>
                            <em>
                                Space Manager
                            </em>
                        </strong>
                    </p>
                    <br/>
                    <p class="lead text-center">
                        ¡Estamos a un solo paso de activar tu cuenta en
                        <strong>
                            Space Manager!
                        </strong>
                    </p>
                    <p class="text-center">
                        Con nuestra plataforma de
                        <em>
                            Administración de Espacios
                        </em>
                        podrás solicitar algún espacio que requieras de una forma muy sencilla.
                    </p>
                    <br/>
                    <a class="btn btn-success btn-block" href="{{ url('/confirmacion/'.$email.'/token/'.$codigoConfirmacion) }}">
                        ¡Clic para confirmar cuenta!
                    </a>
                    <br/>
                    <p>
                        En caso de que el botón no funcione, simplemente copia y pega el siguiente enlace en tu navegador.
                    </p>
                    <br/>
                    <a href="#">
                        {{ url('/confirmacion/'.$email.'/token/'.$codigoConfirmacion) }}
                    </a>
                </div>
            </div>
        </div>
        @include('layouts.scripts')
    </body>
</html>
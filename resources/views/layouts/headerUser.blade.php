<header class="main-header">
    <a class="logo" href="{{ url('/inicio') }}">
        <span class="logo-mini">
            <b>
                ES
            </b>
            M
        </span>
        <span class="logo-lg">
            <b>
                Space
            </b>
            Manager
        </span>
    </a>

    <nav class="navbar navbar-static-top">
        <a class="sidebar-toggle" data-toggle="push-menu" href="#" role="button">
            <span class="sr-only">
                Toggle navigation
            </span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown notifications-menu">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell-o">
                        </i>
                        <span class="label label-warning">
                            {{ count($notificacionesAprobadas) }}
                        </span>
                    </a>
                    <ul class="dropdown-menu" style="width: 300px;">
                        <li class="header">
                            Usted tiene {{ count($notificacionesAprobadas) }} notificacione.
                        </li>
                        <li>
                            <ul class="menu">
                                @foreach ($notificacionesAprobadas as $notificacion)
                                <li>
                                    <input name="notifiacion_id" type="hidden" value="{{ $notificacion->id }}"/>
                                    <a href="{{ route('solicitud.ver',$notificacion->id) }}">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img src="{{ Storage::url($notificacion->solicitud->aprobo->foto) ? Storage::url($notificacion->solicitud->aprobo->foto) : asset('img/userA.png') }}" width="35px"/>
                                            </div>
                                            <div class="col-md-6">
                                                <strong>
                                                    {{ $notificacion->solicitud->espacio->nombre }}
                                                </strong>
                                                <br/>
                                                {{ $notificacion->solicitud->aprobo->nombre.' '. $notificacion->solicitud->aprobo->apellidoP . ' '. $notificacion->solicitud->aprobo->apellidoM }}
                                                <br/>
                                                {{ $notificacion->updated_at->format('l j F') .'... '. $notificacion->updated_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="{{ route('solicitud.index') }}">
                                Ver todas
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown notifications-menu">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope-o">
                        </i>
                        <span class="label label-success">
                            {{ count($correo_usuarios) }}
                        </span>
                    </a>
                    <ul class="dropdown-menu" style="width: 300px;">
                        <li class="header">
                            Mensajes nuevos
                        </li>
                        <li>

                            <ul class="menu">
                                @foreach ($correo_usuarios as $mensaje)
                                <li>
                                    <a href="{{ route('mensaje.show',$mensaje->id) }}">
                                        <strong>
                                            {{ $mensaje->asunto }}
                                        </strong>
                                        <br/>
                                        {{ substr($mensaje->mensaje,0,40) }}...
                                        <br/>
                                        {{ $mensaje->created_at->diffForHumans() }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="">
                                Ver todas
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown user user-menu">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <img alt="User Image" class="user-image" src="{{ Auth::user()->foto ? Storage::url(Auth::user()->foto) : asset('img/user.png') }}">
                            <span class="hidden-xs text-capitalize">
                                {{ Auth::user()->nombre .' '. Auth::user()->apellidoP}}
                            </span>
                        </img>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img alt="User Image" class="img-circle" src="{{ Auth::user()->foto ? Storage::url(Auth::user()->foto) : asset('img/user.png') }}">
                                <p class="text-capitalize">
                                    {{ Auth::user()->nombreCompleto }}
                                    <small class="lead">
                                        @switch(Auth::user()->tipoCuenta)
                                          @case(0)
                                              Administrador
                                              @break
                                          @case(1)
                                              Responsable de Area
                                              @break
                                          @case(2)
                                              Profesor
                                              @break
                                          @case(3)
                                              Alumno
                                              @break
                                          @default
                                              Tipo de Usuario no definido
                                        @endswitch
                                    </small>
                                </p>
                            </img>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a class="btn btn-primary btn-flat" href="{{ route('perfil') }}">
                                    <i class="fa fa-user">
                                    </i>
                                    Perfil
                                </a>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-danger btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out">
                                    </i>
                                    {{ __('Logout') }}
                                </a>
                                <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<header class="main-header">
    <a class="logo" href="{{ url('/admin') }}">
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
                @if (Auth::user()->tipoCuenta==1)
                    @include('layouts.notificacionesResponsable')
                @endif
               @if (Auth::user()->tipoCuenta==0)
                    @include('layouts.notificacionesAdministrador')
                @endif

                {{-- Mensajes --}}
                <li class="dropdown notifications-menu">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope-o">
                        </i>
                        <span class="label label-success">
                            {{ count($correo) }}
                        </span>
                    </a>
                    <ul class="dropdown-menu" style="width: 300px;">
                        <li class="header">
                            Mensajes nuevos
                        </li>
                        <li>
                            <ul class="menu">
                                @foreach ($correo as $mensaje)
                                <li>
                                    <a href="{{ route('correo.show',$mensaje->id) }}">
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
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <img alt="User Image" class="user-image" src="{{ Auth::user()->foto ? Storage::url(Auth::user()->foto) : asset('img/userA.png') }}">
                            <span class="hidden-xs text-capitalize">
                                {{ Auth::user()->nombre .' '. Auth::user()->apellidoP}}
                            </span>
                        </img>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img alt="User Image" class="img-circle" src="{{ Auth::user()->foto ? Storage::url(Auth::user()->foto) : asset('img/userA.png') }}">
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
                                <a class="btn btn-primary btn-flat" href="{{ route('admin.perfil') }}">
                                    <i class="fa fa-user">
                                    </i>
                                    Perfil
                                </a>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-danger btn-flat" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out">
                                    </i>
                                    {{ __('Logout') }}
                                </a>
                                <form action="{{ route('admin.logout') }}" id="logout-form" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                {{--
                <li>
                    <a data-toggle="control-sidebar" href="#">
                        <i class="fa fa-gears">
                        </i>
                    </a>
                </li>
                --}}
            </ul>
        </div>
    </nav>
</header>

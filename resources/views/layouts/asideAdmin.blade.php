<aside class="main-sidebar" name"asideAdmin" id="asideAdmin">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img alt="User Image" class="" src="{{ Storage::url(Auth::user()->foto) }}">
                </img>
            </div>
            <div class="pull-left info">
                <p>
                    {{ Auth::user()->nombre }}
                </p>
                <a href="#">
                    <i class="fa fa-circle text-success">
                    </i>
                    Online
                </a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header text-uppercase">
                Navegacion Principal
            </li>
            <li class="nav-item {{ request()->is('admin') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/admin') }}">
                    <i class="fa fa-dashboard">
                    </i>
                    <span>
                        Dashboard
                    </span>
                </a>
            </li>
            @can('usuarios.index' || 'users.index')
            <li class="treeview {{ request()->is('admin/users') ? 'active' : '' }}">
                <a class="nav-link" href="#">
                    <i class="fa fa-users">
                    </i>
                    <span>
                        Usuarios
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right">
                        </i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('users.index')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-circle-o">
                            </i>
                            Administrador
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right">
                                </i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @can('users.index')
                            <li>
                                <a href="{{ route('users.index') }}">
                                    <i class="fa fa-circle-o">
                                    </i>
                                    Listar Registros
                                </a>
                            </li>
                            @endcan                            
                            @can('users.create')
                            <li class="">
                                <a href="{{ route('users.create') }}">
                                    <i class="fa fa-circle-o">
                                    </i>
                                    Nuevo Registro
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan                    
                    @can('usuarios.index')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-circle-o">
                            </i>
                            Alumno - Profesor
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right">
                                </i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @can('usuarios.index')
                            <li>
                                <a href="{{ route('usuarios.index') }}">
                                    <i class="fa fa-circle-o">
                                    </i>
                                    Listar Registros
                                </a>
                            </li>
                            @endcan
                            @can('usuarios.create')
                            <li>
                                <a href="{{ route('usuarios.create') }}">
                                    <i class="fa fa-circle-o">
                                    </i>
                                    Nuevo Registro
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
           
            {{-- Areas --}}
            @can('areas.index')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-university">
                    </i>
                    <span>
                        Areas
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right">
                        </i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('areas.index')
                    <li>
                        <a href="{{ route('areas.index') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Listar Registros
                        </a>
                    </li>
                    @endcan
                    @can('areas.create')
                    <li>
                        <a href="{{ route('areas.create') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Nuevo Registro
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            
            {{-- Elementos --}}
            @can('elementos.index' || 'categoria-elementos.index')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cubes">
                    </i>
                    <span>
                        Elementos
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right">
                        </i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('categoria-elementos.index')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-circle-o">
                            </i>
                            Categorias
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right">
                                </i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @can('categoria-elementos.index')
                            <li>
                                <a href="{{ route('categoria-elementos.index') }}">
                                    <i class="fa fa-circle-o">
                                    </i>
                                    Listar Registros
                                </a>
                            </li>
                            @endcan
                            @can('categoria-elementos.create')
                            <li>
                                <a href="{{ route('categoria-elementos.create') }}">
                                    <i class="fa fa-circle-o">
                                    </i>
                                    Nuevo Registro
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('elementos.index')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-circle-o">
                            </i>
                            Elementos
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right">
                                </i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @can('elementos.index')
                            <li>
                                <a href="{{ route('elementos.index') }}">
                                    <i class="fa fa-circle-o">
                                    </i>
                                    Listar Registros
                                </a>
                            </li>
                            @endcan
                            @can('elementos.create')
                            <li>
                                <a href="{{ route('elementos.create') }}">
                                    <i class="fa fa-circle-o">
                                    </i>
                                    Nuevo Registro
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            {{-- Espacios Academicos --}}
            @can('espacios.index')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-building">
                    </i>
                    <span>
                        Espacios Academicos
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right">
                        </i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('espacios.index')
                    <li>
                        <a href="{{ route('espacios.index') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Listar Registros
                        </a>
                    </li>
                    @endcan
                    @can('espacios.create')
                    <li>
                        <a href="{{ route('espacios.create') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Nuevo Registro
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            
            {{-- Solicitudes --}}
            @can('solicitudes.index')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-o">
                    </i>
                    <span>
                        Solicitudes
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right">
                        </i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('solicitudes.index')
                    <li>
                        <a href="{{ route('solicitudes.index') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Listar Solicitudes
                        </a>
                    </li>
                    @endcan
                    @can('solicitudes.create')
                    <li>
                        <a href="{{ route('solicitudes.create') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Nueva Solicitud
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan

            {{-- Elementos --}}
            <li class="treeview">
                {{--
                <a href="#">
                    <i class="fa fa-laptop">
                    </i>
                    <span>
                        Solicitar Elementos
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right">
                        </i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('solicitudes-elementos.index') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Listar Solicitudes
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('solicitudes-elementos.create') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Nueva Solicitud
                        </a>
                    </li>
                </ul>
            </li>
            --}}
            {{-- Actividades Academicas --}}
            @can('horario-escolar.index')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-calendar-times-o">
                    </i>
                    <span>
                        Calendario Escolar
                        <br/>
                        (Horarios)
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right">
                        </i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('horario-escolar.index')
                    <li>
                        <a href="{{ route('calendarios.index') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Listar Horarios
                        </a>
                    </li>
                    @endcan
                    @can('horario-escolar.index')
                    <li>
                        <a href="{{ route('calendarios.horarios') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Listar Tabla de Horarios
                        </a>
                    </li>
                    @endcan
                    @can('horario-escolar.create')
                    <li>
                        <a href="{{ route('calendarios.create') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Nueva Horario
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            
            {{-- Mensajes --}}
            <li>
                <a href="{{ route('mensajes.index') }}">
                    <i class="fa fa-envelope">
                    </i>
                    <span>
                        Bandeja de entrada
                    </span>
                </a>
            </li>
            {{-- Evaluaciones  --}}
            @if (Auth::user()->tipoCuenta==1)
            <li>
                <a href="{{ route('evaluaciones.index') }}">
                    <i class="fa fa-star-half-o">
                    </i>
                    <span>
                        Evaluaciones
                    </span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-red">
                            {{ count($evaluaciones) }}
                        </small>
                    </span>
                </a>
            </li>
            @endif
          
            {{-- Reportes --}}
          {{--
            <li>
                <a href="{{ route('reportes.index') }}">
                    <i class="fa fa-pie-chart">
                    </i>
                    <span>
                        Reportes
                    </span>
                </a>
            </li>
            --}}
            {{-- Roles y permisos --}}
            @can('roles.index', Model::class)
            <li>
                <a href="{{ route('roles.index') }}">
                    <i class="fa fa-check-square-o">
                    </i>
                    <span>
                        Roles y Permisos
                    </span>
                </a>
            </li>
            @endcan
            <li>
                <a href="{{ route('log-viewer::dashboard') }}">
                    <i class="fa fa-circle-o text-aqua">
                    </i>
                    <span>
                        Information
                    </span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
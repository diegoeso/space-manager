<aside class="main-sidebar" id="asideAdmin" name"asideadmin"="">
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
    <!--<li class="nav-item {{ request()->is('admin') ? 'active' : '' }}">-->
        <li class="nav-item {{request()->is('admin') ? 'active' : ''}}">
            <a class="nav-link" href="{{ url('/admin') }}">
                <i class="fa fa-dashboard">
                </i>
                <span>
                        Dashboard
                    </span>
            </a>
        </li>
        @can('usuarios.index' || 'users.index')
            <li @if(request()->is('admin/users') || request()->is('admin/usuarios')||request()->is('admin/users/*') || request()->is
            ('admin/usuarios/*')) class="treeview active"
                @else
                class="treeview"
                    @endif>
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
                        <li @if(request()->is('admin/users') || request()->is('admin/users/*')) class="treeview
                        active" @else class="treeview" @endif>
                            <a href="#">
                                <i class="fa fa-circle-o">
                                </i>
                                Administradores
                                <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right">
                                </i>
                            </span>
                            </a>
                            <ul class="treeview-menu">
                                @can('users.index')
                                    <li @if(request()->is('admin/users')) class="active" @else class="" @endif>
                                        <a href="{{ route('users.index') }}">
                                            <i class="fa fa-circle-o">
                                            </i>
                                            Listar Registros
                                        </a>
                                    </li>
                                @endcan
                                @can('users.create')
                                    <li @if(request()->is('admin/users/crear')) class="active" @else class="" @endif>
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
                        <li @if(request()->is('admin/usuarios') || request()->is('admin/usuarios/*')) class="treeview
                        active" @else class="treeview" @endif>
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
                                    <li @if(request()->is('admin/usuarios')) class="active" @else class="" @endif>
                                        <a href="{{ route('usuarios.index') }}">
                                            <i class="fa fa-circle-o">
                                            </i>
                                            Listar Registros
                                        </a>
                                    </li>
                                @endcan
                                @can('usuarios.create')
                                    <li @if(request()->is('admin/usuarios/crear')) class="active" @else class="" @endif>
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
            <li @if(request()->is('admin/areas') || request()->is('admin/areas/*')) class="treeview
                        active" @else class="treeview" @endif>
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
                        <li @if(request()->is('admin/areas')) class="active" @else class="" @endif>
                            <a href="{{ route('areas.index') }}">
                                <i class="fa fa-circle-o">
                                </i>
                                Listar Registros
                            </a>
                        </li>
                    @endcan
                    @can('areas.create')
                        <li @if(request()->is('admin/areas/crear')) class="active" @else class="" @endif>
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
            <li @if(request()->is('admin/elementos') || request()->is('admin/elementos/*') || request()->is
            ('admin/categoria-elementos') || request()->is('admin/categoria-elementos/*')) class="treeview
                        active" @else class="treeview" @endif>
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
                        <li @if(request()->is('admin/categoria-elementos') || request()->is('admin/categoria-elementos/*'))
                            class="treeview
                        active" @else class="treeview" @endif>
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
                                    <li @if(request()->is('admin/categoria-elementos')) class="active" @else class=""
                                            @endif>
                                        <a href="{{ route('categoria-elementos.index') }}">
                                            <i class="fa fa-circle-o">
                                            </i>
                                            Listar Registros
                                        </a>
                                    </li>
                                @endcan
                                @can('categoria-elementos.create')
                                    <li @if(request()->is('admin/categoria-elementos/crear')) class="active"
                                        @else class=""
                                            @endif>
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
                        <li @if(request()->is('admin/elementos') || request()->is('admin/elementos/*')) class="treeview
                    active" @else class="treeview" @endif>
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
                                    <li @if(request()->is('admin/elementos')) class="active" @else class="" @endif>
                                        <a href="{{ route('elementos.index') }}">
                                            <i class="fa fa-circle-o">
                                            </i>
                                            Listar Registros
                                        </a>
                                    </li>
                                @endcan
                                @can('elementos.create')
                                    <li @if(request()->is('admin/elementos/crear')) class="active"
                                        @else class="" @endif>
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
            <li @if(request()->is('admin/espacios') || request()->is('admin/espacios/*')) class="treeview active"
                @else class="treeview" @endif>
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
                        <li @if(request()->is('admin/espacios')) class="active" @else class="" @endif>
                            <a href="{{ route('espacios.index') }}">
                                <i class="fa fa-circle-o">
                                </i>
                                Listar Registros
                            </a>
                        </li>
                    @endcan
                    @can('espacios.create')
                        <li @if(request()->is('admin/espacios/crear')) class="active" @else class="" @endif>
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
            <li @if(request()->is('admin/solicitudes') || request()->is('admin/solicitudes/*')) class="treeview active"
                @else class="treeview" @endif>
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
                        <li @if(request()->is('admin/solicitudes')) class="active" @else class="" @endif>
                            <a href="{{ route('solicitudes.index') }}">
                                <i class="fa fa-circle-o">
                                </i>
                                Listar Solicitudes
                            </a>
                        </li>
                    @endcan
                    @can('solicitudes.create')
                        <li @if(request()->is('admin/solicitudes/crear')) class="active" @else class="" @endif>
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

        {{-- Actividades Academicas --}}
        @can('horario-escolar.index')
            <li @if(request()->is('admin/calendarios') || request()->is('admin/calendarios/*') || request()->is
            ('admin/calendarios-horarios')) class="treeview
            active" @else class="treeview" @endif>
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
                        <li @if(request()->is('admin/calendarios')) class="active" @else class="" @endif>
                            <a href="{{ route('calendarios.index') }}">
                                <i class="fa fa-circle-o">
                                </i>
                                Listar Horarios
                            </a>
                        </li>
                    @endcan
                    @can('horario-escolar.index')
                        <li @if(request()->is('admin/calendarios-horarios')) class="active" @else class="" @endif>
                            <a href="{{ route('calendarios.horarios') }}">
                                <i class="fa fa-circle-o">
                                </i>
                                Listar Tabla de Horarios
                            </a>
                        </li>
                    @endcan
                    @can('horario-escolar.create')
                        <li @if(request()->is('admin/calendarios/crear')) class="active" @else class="" @endif>
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

        {{--Correo--}}
        <li @if(request()->is('admin/correo') || request()->is('admin/correo-*') || request()->is
        ('admin/correo/crear'))
            class="treeview active" @endif>
            <a href="{{ route('correo.index') }}">
                <i class="fa fa-envelope">
                </i>
                <span>
                    Bandeja de Entrada
                </span>
            </a>
        </li>
        {{-- Evaluaciones  --}}
        @if (Auth::user()->tipoCuenta==1)
            <li @if(request()->is('evaluaciones')|| request()->is('evaluaciones/*')) class="treeview active" @endif>
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

        {{-- Roles y permisos --}}
        @can('roles.index', Model::class)
            <li @if(request()->is('admin/roles') || request()->is('admin/roles/*')) class="treeview active" @endif>
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

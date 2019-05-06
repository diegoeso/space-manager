<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                {{--
                <img alt="User Image" class="img-circle" src="{{ Storage::url(Auth::user()->foto) }}">
                </img>
                --}}
                <img alt="User Image" class="user-image" src="{{Auth::user()->foto ? Storage::url(Auth::user()->foto) : asset('img/user.png') }}">
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
            {{--
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard">
                    </i>
                    <span>
                        Dashboard
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right">
                        </i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active">
                        <a href="index.html">
                            <i class="fa fa-circle-o">
                            </i>
                            Dashboard v1
                        </a>
                    </li>
                    <li>
                        <a href="index2.html">
                            <i class="fa fa-circle-o">
                            </i>
                            Dashboard v2
                        </a>
                    </li>
                </ul>
            </li>
            --}}
            <li>
                <a href="{{url('/inicio') }}">
                    <i class="fa fa-dashboard">
                    </i>
                    <span>
                        Dashboard
                    </span>
                </a>
            </li>
            {{-- Solicitudes --}}
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
                    <li>
                        <a href="{{ route('solicitud.index') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Listar Solicitudes
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('solicitud.create') }}">
                            <i class="fa fa-circle-o">
                            </i>
                            Nueva Solicitud
                        </a>
                    </li>
                </ul>
            </li>
            {{-- Actividades Academicas --}}
            {{--
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-calendar-times-o">
                    </i>
                    <span>
                        Actividades Academicas
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right">
                        </i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="">
                            <i class="fa fa-circle-o">
                            </i>
                            Listar Solicitudes
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-circle-o">
                            </i>
                            Nueva Solicitud
                        </a>
                    </li>
                </ul>
            </li>
            --}}
            {{-- Mensajes --}}
            <li>
                <a href="{{ route('mensaje.index') }}">
                    <i class="fa fa-envelope">
                    </i>
                    <span>
                        Bandeja de entrada
                    </span>
                </a>
            </li>
            {{-- Evaluaciones  --}}
           {{--
            <li class="treeview">
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
            --}}
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
            {{-- Reportes --}}
            {{--
            <li>
                <a href="#">
                    <i class="fa fa-pie-chart">
                    </i>
                    <span>
                        Reportes
                    </span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-circle-o text-aqua">
                    </i>
                    <span>
                        Information
                    </span>
                </a>
            </li>
            --}}
        </ul>
    </section>
</aside>
<div class="col-md-3">
    <a class="btn btn-primary btn-block margin-bottom" href="{{ route('correo.create') }}">
        Nuevo
    </a>
    <div class="box box-solid">
        <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
                <li @if(Request::path() == 'admin/correo') class="active" @else class="" @endif>
                    <a href="{{ route('correo.index') }}">
                        <i class="fa fa-inbox">
                        </i>
                        Entrada
                        <span class="label label-primary pull-right">
                            {{ count($correo) }}
                        </span>
                    </a>
                </li>
                <li @if(Request::path() == 'admin/correo-enviados') class="active" @else class="" @endif>
                    <a href="{{route('correo.enviados')}}">
                        <i class="fa fa-envelope-o">
                        </i>
                        Enviados
                        <span class="label label-warning pull-right">
                            {{ count($correo_enviado) }}
                        </span>
                    </a>
                </li>
                <li @if(Request::path() == 'admin/correo-borrados') class="active" @else class="" @endif>
                    <a href="{{route('correo.eliminados')}}">
                        <i class="fa fa-trash-o"></i>
                        Eliminados
                        <span class="label label-danger pull-right">
                            {{ count($correo_eliminado) }}
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
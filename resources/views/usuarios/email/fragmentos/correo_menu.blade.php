<div class="col-md-3">
    <a class="btn btn-primary btn-block margin-bottom" href="{{ route('mensaje.create') }}">
        Nuevo
    </a>
    <div class="box box-solid">
        <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
                <li @if(Request::path() == 'mensaje') class="active" @else class="" @endif>
                    <a href="{{ route('mensaje.index') }}">
                        <i class="fa fa-inbox">
                        </i>
                        Entrada
                        <span class="label label-primary pull-right">
                            {{ count($correo_usuarios) }}
                        </span>
                    </a>
                </li>
                <li @if(Request::path() == 'mensaje-enviados') class="active" @else class="" @endif>
                    <a href="{{route('mensaje.enviados')}}">
                        <i class="fa fa-envelope-o">
                        </i>
                        Enviados
                        <span class="label label-warning pull-right">
                            {{ count($correo_enviado_usuarios) }}
                        </span>
                    </a>
                </li>
                <li @if(Request::path() == 'mensajes-borrados') class="active" @else class="" @endif>
                    <a href="{{route('mensaje.eliminados')}}">
                        <i class="fa fa-trash-o"></i>
                        Eliminados
                        <span class="label label-danger pull-right">
                            {{ count($mensajes_eliminados) }}
                        </span>
                    </a>
                </li>
            </ul>
            <hr>
            <p class="text-center">Correos administrativos</p>
            <ul class="list-group">
                @foreach($correos_admins as $admin)
                    <li class="list-group-item">
                        {{$admin->email}}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

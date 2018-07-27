{{-- Notificaciones de nuevas solicitudes administradores --}}
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
            Usted tiene {{ count($notificacionesAprobadas) }} solicitudes pendientes.
        </li>
        <li>
            <ul class="menu">
                @foreach ($notificacionesAprobadas as $notificacion)
                <li>
                    <input name="notifiacion_id" type="hidden" value="{{ $notificacion->id }}"/>
                    <a href="{{ route('solicitudes.ver',$notificacion->id) }}">
                        <div class="row">
                            <div class="col-md-2">
                                @if ($notificacion->solicitud->tipoUsuario==0||$notificacion->solicitud->tipoUsuario==1)
                                <img src="{{ Storage::url($notificacion->solicitud->solicitanteAdmin->foto) }}" width="35px"/>
                                @else
                                <img src="{{ Storage::url($notificacion->solicitud->solicitante->foto) }}" width="35px"/>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <strong>
                                    {{ $notificacion->solicitud->espacio->nombre }}
                                </strong>
                                <br/>
                                @if ($notificacion->solicitud->tipoUsuario==0||$notificacion->solicitud->tipoUsuario==1)
                                    {{ $notificacion->solicitud->solicitanteAdmin->nombre.' '. $notificacion->solicitud->solicitanteAdmin->apellidoP . ' '. $notificacion->solicitud->solicitanteAdmin->apellidoM }}
                                @else
                                    {{ $notificacion->solicitud->solicitante->nombre.' '. $notificacion->solicitud->solicitante->apellidoP . ' '. $notificacion->solicitud->solicitante->apellidoM }}
                                @endif
                                <br/>
                                {{ $notificacion->solicitud->fechaInicio->format('l j F') .'... '. $notificacion->solicitud->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
        </li>
        <li class="footer">
            <a href="{{ route('solicitudes.index') }}">
                Ver todas
            </a>
        </li>
    </ul>
</li>

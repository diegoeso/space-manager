<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Fecha Inicio</th>
        <th>Fecha Fin</th>
        <th>Hora Inicio</th>
        <th>Hora Fin</th>
        <th>Actividad</th>
        <th>Asistentes</th>
        <th>Solicitante</th>
        <th>Tipo de Usuario</th>
        <th>Estado</th>
        <th>Motivo</th>
        <th>Área</th>
        <th>Espacio</th>
    </tr>
    </thead>
    <tbody>
    @foreach($solicitudes as $solicitud)
        <tr>
            <td>{{ $solicitud->id }}</td>
            <td>{{ $solicitud->fechaInicio }}</td>
            <td>{{ $solicitud->fechaFin }}</td>
            <td>{{ $solicitud->horaInicio }}</td>
            <td>{{ $solicitud->horaFin }}</td>
            <td>{{ $solicitud->actividadAcademica }}</td>
            <td>{{ $solicitud->asistentesEstimados }}</td>
            <td>{{ $solicitud->nombreUsuarioSolicitante($solicitud) }}</td>
            <td>
                @switch($solicitud->tipoUsuario)
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
                @endswitch
            </td>
            <td>
                @switch($solicitud->estado)
                    @case(1)
                        Aprobada
                        @break
                    @case(2)
                        Rechazada
                        @break
                    @case(3)
                       Cancelada
                        @break
                    @case(4)
                        Finalizada
                        @break
                @endswitch
            </td>
            <td>{{ $solicitud->motivo }}</td>
            <td>{{ $solicitud->area->nombre }}</td>
            <td>{{ $solicitud->espacio->nombre }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
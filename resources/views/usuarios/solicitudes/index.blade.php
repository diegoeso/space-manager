@extends('layouts.admin')
@section('navegacion')
<section class="content-header">
    <h1>
        <small>
            Panel de Control
        </small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ url('/inicio') }}">
                <i class="fa fa-dashboard">
                </i>
                Home
            </a>
        </li>
        <li class="active">
            Solicitudes
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            @include('general.botonNuevo', ['modulo' => 'Listado de Solicitudes','ruta'=>'solicitud.create'])
            <div class="box-body">
                <div class="row" style="padding-bottom: 5px;">
                    <div class="col-md-12 ">
                        <a class="btn bg-navy margin btn-xs pull-right" href="{{ route('pdf.solicitudesU') }}" target="_black">
                            <i class="fa fa-file-pdf-o">
                            </i>
                            Descargar PDF
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="solicitudes-table">
                        <thead>
                            <tr>
                                <th width="10">
                                    ID
                                </th>
                                {{--
                                <th>
                                    Solicitante
                                </th>
                                --}}
                                <th>
                                    Espacio Solicitado
                                </th>
                                <th>
                                    Fecha de Actividad
                                </th>
                                <th>
                                    Hora de Actividad
                                </th>
                                <th>
                                    Estado
                                </th>
                                <th>
                                    Creación
                                </th>
                                <th width="20">
                                    Opciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $datable=$('#solicitudes-table').DataTable({
            language:{
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
            processing: true,
            serverSide: true,
            info: true,
            autoWidth: false,
            select: true,
            // order: [[0, 'desc']],
            ajax: "solicitud/listarSolicitudesUsuario/1",
            columns: [
                {data: 'id', name: 'id'},
                // {data: 'usuarioSolicitud', name: 'usuarioSolicitud'},
                {data: 'espacio_id', name: 'espacio_id'},
                {data: 'fechaInicio', name: 'fechaInicio'},
                {data: 'horaInicio', name: 'horaInicio'},
                {data: 'estado', render:function($estado){
                    switch ($estado) {
                    case '1':
                        return '<span class="label label-success">Aprobada</span>';
                        break;
                    case '2':
                        return '<span class="label label-warning">Rechazada</span>';
                        break;
                    case '3':
                        return '<span class="label label-danger">Cancelada</span>';
                        break;
                    case '4':
                        return '<span class="label label-default">Finalizada</span>';
                        break;

                    default:
                    return '<span class="label label-info">Pendiente</span>';
                    break;
                }
                }},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: true, searchable: true}
            ],
            order: [[0, 'desc']]
        });

        $("body").on("click", "#solicitudes-table #btnEliminar", function(event) {
            event.preventDefault();
            var r = confirm('¿Desea eliminar el registro? ¡Al eliminar este registro, se eliminaran todos los datos asociados al mismo!');
            if (r == true) {
                var idsele = $(this).attr("value");
                var token = $("#token").val();
                $.ajax({
                    url: 'solicitud/'+idsele,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(data){
                        if (data.success == 'true')
                        {
                            toastr["success"]('¡El registro se elimino exitosamente!');
                            $datable.ajax.reload();
                        }
                        else
                        {
                            toastr["error"]('¡El registro no se pudo eliminar!');
                            $datable.ajax.reload();   
                        }
                    }
                });                
            }
        });
    });
</script>
@endsection

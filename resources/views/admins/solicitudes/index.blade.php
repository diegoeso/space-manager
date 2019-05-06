{{ Toastr::clear() }}
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
            <a href="{{ url('/admin') }}">
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
    <input id="token" name="_token" type="hidden" value="{{ csrf_token() }}"/>
    <div class="col-xs-12">
        <div class="box box-primary">

             <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-list-ul">
                    </i>
                    Listado de registros
                </h3>
                <div class="box-tools">
                     <div class="btn-group pull-right">
                        <button class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" type="button">
                            Opciones
                            <span class="caret">
                            </span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="" href="{{ route('solicitudes.create')}}">
                                    <span class="fa fa-plus">
                                    </span>
                                    Nuevo Registro
                                </a>
                            </li>
                            <li>
                                <a class="" href="{{ route('pdf.solicitudes') }}" target="_black">
                                    <i class="fa fa-file-pdf-o">
                                    </i>
                                    Descargar PDF
                                </a>
                            </li>
                            <li>
                                <a class="" href="{{ route('admin.export-solicitud') }}">
                                    <i class="fa fa-file-excel-o">
                                    </i>
                                    Exportar Excel
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    {{-- @include('general.mensaje') --}}
                    <table class="table table-hover" id="solicitudes-table">
                        <thead>
                            <tr>
                                <th width="10">
                                    No
                                </th>
                                <th>
                                    Solicitante
                                </th>
                                <th>
                                    Usuario
                                </th>
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
            ajax: "solicitudes/listarSolicitudes/1",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'usuarioSolicitud', name: 'usuarioSolicitud'},
                {data: 'tipoUsuario', name: 'tipoUsuario'},
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

        $("body").on("click", "#solicitudes-table #btnEliminar", function (event) {
            event.preventDefault();
            var idsele = $(this).attr("value");
            var token = $("#token").val();
            alertify.confirm("Eliminar registro ", "¿Desea eliminar el registro? ¡Al eliminar este registro, se eliminaran todos los datos asociados al mismo!",
                function () {
                    $.ajax({
                        url: 'solicitudes/'+idsele,
                        headers: {'X-CSRF-TOKEN': token},
                        type: 'DELETE',
                        dataType: 'json',
                        success: function (data) {
                            if (data.success == 'true') {
                                toastr["success"]('¡El registro se elimino exitosamente!');
                                $datable.ajax.reload();
                            }
                            else {
                                toastr["error"]('¡El registro no se pudo eliminar!');
                                $datable.ajax.reload();
                            }
                        }
                    });
                },
                function () {
                    alertify.notify('Sin acción')
                }
            );
        });
    });



     toastr.options = {
         "closeButton": true,
         "debug": false,
         "newestOnTop": false,
         "progressBar": true,
         "positionClass": "toast-top-right",
         "preventDuplicates": false,
         "onclick": null,
         "showDuration": "300",
         "hideDuration": "1000",
         "timeOut": "5000",
         "extendedTimeOut": "1000",
         "showEasing": "swing",
         "hideEasing": "linear",
         "showMethod": "fadeIn",
         "hideMethod": "fadeOut"
     }
</script>
@endsection

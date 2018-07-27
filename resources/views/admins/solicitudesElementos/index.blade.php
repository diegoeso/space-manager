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
            Solicitud Elementos
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            @include('general.botonNuevo', ['modulo' => 'Listado de Solicitudes','ruta'=>'solicitudes-elementos.create'])
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="solicitudesElementos-table">
                        <thead>
                            <tr>
                                <th width="10">
                                    ID
                                </th>
                                <th>
                                    Elemento
                                </th>
                                <th>
                                    Categoria
                                </th>
                                <th>
                                    Cantidad
                                </th>
                                <th>
                                    Fecha
                                </th>
                                <th>
                                    Hora de Inicio
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
        $('#solicitudesElementos-table').DataTable({
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
            ajax: "solicitudes-elementos/listarSolicitudesUsuario/1",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'elemento_id', name: 'elemento_id'},
                {data: 'categoria_id', name: 'categoria_id'},
                {data: 'cantidad', name: 'cantidad'},
                {data: 'fecha', name: 'fecha'},
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
            // order: [[0, 'desc']],
        });
    });
</script>
@endsection

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
            Áreas
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
                        <button class="btn btn-info dropdown-toggle" data-toggle="dropdown" type="button">
                            Opciones
                            <span class="caret">
                            </span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="" href="{{ route('areas.create')}}">
                                    <span class="fa fa-plus">
                                    </span>
                                    Nuevo Registro
                                </a>
                            </li>
                            <li>
                                <a class="" href="{{ route('pdf.areas') }}" target="_black">
                                    <i class="fa fa-file-pdf-o">
                                    </i>
                                    Descargar PDF
                                </a>
                            </li>
                            <li>
                                <a class="" href="{{ route('admin.export-area') }}">
                                    <i class="fa fa-file-excel-o">
                                    </i>
                                    Exportar Excel
                                </a>
                            </li>
                            <li>
                                <a data-target="#myModal" data-toggle="modal">
                                    <i class="fa fa-upload">
                                    </i>
                                    Importar Excel
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row" style="padding-bottom: 5px;">
                    <div class="col-md-12 ">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="areas-table">
                        <thead>
                            <tr>
                                <th width="10">
                                    ID
                                </th>
                                <th>
                                    Nombre
                                </th>
                                <th>
                                    Descripción
                                </th>
                                <th width="200px">
                                    Encargado
                                </th>
                                <th colspan="" width="20px">
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
<div aria-labelledby="myModalLabel" class="modal fade" id="myModal" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Importar Datos
                </h4>
            </div>
            <form action="{{ route('admin.import-area') }}" enctype="multipart/form-data" method="post">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div>
                        <label for="file">
                            Archivo:
                        </label>
                        <input class="form-control" id="file" name="file" type="file"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">
                        Cerrar
                    </button>
                    <button class="btn btn-primary" type="submit">
                        Importar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $datable=$('#areas-table').DataTable({
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
            info: false,
            autoWidth: true,
            select: true,
            ajax: "areas/listarAreas/1",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nombre', name: 'nombre'},
                {data: 'descripcion', name: 'descripcion'},
                {data: 'user_id', name: 'user_id'},
                {data: 'action', name: 'action', orderable: true, searchable: true}
            ]
        });

        $("body").on("click", "#areas-table #btnEliminar", function (event) {
            event.preventDefault();
            var idsele = $(this).attr("value");
            var token = $("#token").val();
            alertify.confirm("Eliminar registro ", "¿Desea eliminar el registro? ¡Al eliminar este registro, se " +
                "eliminaran todos los datos relacionados al mismo!",
                function () {
                    $.ajax({
                        url: 'areas/'+idsele,
                        headers: {'X-CSRF-TOKEN': token},
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
                },
                function () {
                    alertify.notify('Sin acción')
                }
                //).set({'closableByDimmer': false});
            );
        });
    });
</script>
@endsection

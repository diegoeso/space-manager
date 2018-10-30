@extends('layouts.admin')
@section('navegacion')
<section class="content-header">
    <h1>
        {{-- @include('general.tipoUsuario') --}}
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
            Mensajes
        </li>
    </ol>
</section>
@endsection
@section('content')
<section class="content">
    <div class="row">
        @include('admins.email.fragmentos.correo_menu')
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Bandeja de salida
                    </h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover" id="salida-table">
                            <thead>
                                <tr>
                                    <th width="10">
                                        ID
                                    </th>
                                    <th width="250">
                                        Para
                                    </th>
                                    <th>
                                        Asunto
                                    </th>
                                    <th></th>
                                    <th colspan="" width="20">
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
</section>

@endsection 
@section('script')
<script>
    $(document).ready(function() {
        $datable = $('#salida-table').DataTable({
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
            processing: true,
            serverSide: true,
            info: true,
            autoWidth: true,
            select: true,
            ajax: "correo/salida/"+'{{ Auth::user()->email }}',
            columns: [
                {data: 'id', render:function ($id) {
                    return '<i class="fa fa-paper-plane-o"></i>'
                }},
                {data: 'para', name: 'para'},
                {data: 'mensaje_res', name: 'mensaje_res'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: true, searchable: true}
            ]
        });

        $("body").on("click", "#salida-table #btnEliminar", function(event) {
            event.preventDefault();
            var idsele = $(this).attr("value");
            var token = $("#token").val();
            alertify.confirm("Eliminar Correo ", "¿Desea eliminar el mensaje?",
                function () {
                    $.ajax({
                        url: 'correo/delete/salida/' + idsele,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            console.log(data);
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
</script>
@endsection

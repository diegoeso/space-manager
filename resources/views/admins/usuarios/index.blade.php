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
            Usuarios
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <input id="token" name="_token" type="hidden" value="{{ csrf_token() }}"/>
    <div class="col-xs-12">
        <div class="box box-primary">
            @include('general.botonNuevo', ['modulo' => 'Listado de Usuarios','ruta'=>'usuarios.create'])
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="usuarios-table">
                        <thead>
                            <tr>
                                <th width="10">
                                    ID
                                </th>
                                <th>
                                    Nombre
                                </th>
                                <th>
                                    Correo
                                </th>
                                <th>
                                    No. Cuenta
                                </th>
                                <th>
                                    Usuario
                                </th>
                                <th>
                                    Carrera
                                </th>
                                <th colspan="" width="20px">
                                    Opciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- data Datatables --}}
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
        $datable=$('#usuarios-table').DataTable({
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
            ajax: "usuarios/listarUsuarios/1",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nombre', name: 'nombre'},
                {data: 'email', name: 'email'},
                {data: 'matricula', name: 'matricula'},
                
                {data: 'tipoCuenta', render: function($d) {
                    switch($d) {
                        case '2':
                            return 'Profesor';
                            break;
                        case '3':
                            return 'Alumno';
                            break;
                        default:
                           return 'Usuario';
                    }
                }},
                {data: 'carrera', name: 'carrera'},
                {data: 'action', name: 'action', orderable: true, searchable: true}
            ]
        });

        $("body").on("click", "#usuarios-table #btnEliminar", function(event) {
            event.preventDefault();
            var r = confirm('Desea eliminar el registro');
            if (r == true) {
                var idsele = $(this).attr("value");
                var token = $("#token").val();
                $.ajax({
                    url: 'usuarios/'+idsele,
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
            }
        });
    });
</script>
@endsection

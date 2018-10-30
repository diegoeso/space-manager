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
            Listado de Horarios
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <input id="token" name="_token" type="hidden" value="{{ csrf_token() }}"/>
    <div class="col-xs-12">
        <div class="box box-primary">
            @include('general.botonNuevo', ['modulo' => 'Listado de Horarios','ruta'=>'calendarios.create'])
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="horarios-table">
                        <thead>
                            <tr>
                                <th width="10">
                                    ID
                                </th>
                                <th>
                                    Materia
                                </th>
                                <th>
                                    Docente
                                </th>
                                <th>
                                    Fecha
                                </th>
                                <th>
                                    Horario
                                </th>
                                <th>
                                    Carrera
                                </th>
                                <th>
                                    Semestre
                                </th>
                                <th>
                                    Grupo
                                </th>
                                <th>
                                    Espacio Académico
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
        $datable=$('#horarios-table').DataTable({
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
            ajax: "calendarios/listarHorarios/1",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'actividadAcademica', name: 'actividadAcademica'},
                {data: 'docente', name: 'docente'},
                {data: 'fechaInicio', name: 'fechaInicio'},
                {data: 'horaInicio', name: 'horaInicio'},
                {data: 'carrera', name: 'carrera'},
                {data: 'semestre', name: 'semestre'},
                {data: 'grupo', name: 'grupo'},
                {data: 'espacio_id', name: 'espacio_id'},
                {data: 'action', name: 'action', orderable: true, searchable: true}    
                
                
            ],
            order: [[0, 'desc']]
        });

        /*$("body").on("click", "#horarios-table #btnEliminar", function(event) {
            event.preventDefault();
            var r = confirm('¿Desea eliminar el registro?');
            if (r == true) {
                var idsele = $(this).attr("value");
                var token = $("#token").val();
                $.ajax({
                    url: 'solicitudes/'+idsele,
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
        });*/

        $("body").on("click", "#horarios-table #btnEliminar", function (event) {
            event.preventDefault();
            var idsele = $(this).attr("value");
            var token = $("#token").val();
            alertify.confirm("Eliminar registro ", "¿Desea eliminar el registro? ¡Al eliminar este registro, se " +
                "eliminaran todos los datos relacionados al mismo!",
                function () {
                    $.ajax({
                        url: 'solicitudes/'+idsele,
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

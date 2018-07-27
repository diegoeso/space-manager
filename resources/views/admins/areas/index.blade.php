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
            Areas
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <input id="token" name="_token" type="hidden" value="{{ csrf_token() }}"/>
    <div class="col-xs-12">
        <div class="box box-primary">
            @include('general.botonNuevo', ['modulo' => 'Listado de Areas','ruta'=>'areas.create'])
            <div class="box-body">
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
                            {{-- @foreach($areas as $area)
                            <tr>
                                <td>
                                    {{ $area->id }}
                                </td>
                                <td>
                                    {{ $area->nombre }}
                                </td>
                                <td width="400">
                                    @php
                                       $descripcion= substr($area->descripcion, 0,100);
                                    @endphp
                                    {{ $descripcion }}...
                                </td>
                                <td>
                                    {{ $area->responsables->nombreCompleto }}
                                </td>
                                <td width="10">
                                    <a class="btn btn-primary btn-xs" href="{{ route('areas.show',$area->id) }}">
                                        <span class="fa fa-eye">
                                        </span>
                                    </a>
                                </td>
                                <td width="10">
                                    <a class="btn btn-success btn-xs" href="{{ route('areas.edit',$area->id) }}">
                                        <span class="fa fa-edit">
                                        </span>
                                    </a>
                                </td>
                                <td width="10">
                                    <form action="{{ route('areas.destroy', $area->id) }}" class="form-inline" method="post">
                                        {{ csrf_field() }}
                                        <input name="_method" type="hidden" value="DELETE"/>
                                        <button class=" btn btn-danger btn-xs" type="submit">
                                            <span class="fa fa-trash">
                                            </span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                    {{-- {!! $areas->render() !!} --}}
                </div>
            </div>
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

        $("body").on("click", "#areas-table #btnEliminar", function(event) {
            event.preventDefault();
            var r = confirm('Desea eliminar el registro');
            if (r == true) {
                var idsele = $(this).attr("value");
                var token = $("#token").val();
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
            }
        });
    });
</script>
@endsection

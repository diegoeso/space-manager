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
            @include('general.botonNuevo', ['modulo' => 'Listado de Categorias','ruta'=>'categoria-elementos.create'])
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="categoria-elementos-table">
                        <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Nombre
                                </th>
                                <th>
                                    Descripción
                                </th>
                                {{--
                                <th>
                                    Permisos
                                </th>
                                --}}
                                <th width="20px">
                                    Opciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {{--                             @foreach ($categorias as $categoria)
                            <tr>
                                <td>
                                    {{ $categoria->id }}
                                </td>
                                <td>
                                    {{ $categoria->nombre }}
                                </td>
                                <td>
                                    @php
                                       $descripcion= substr($categoria->descripcion, 0,100);
                                    @endphp
                                    {{ $descripcion }}...
                                </td>
                                @can('categoria-elementos.show')
                                <td width="10">
                                    <a class="btn btn-primary btn-xs" href="{{ route('categoria-elementos.show',$categoria->id) }}">
                                        <span class="fa fa-eye">
                                        </span>
                                    </a>
                                </td>
                                @endcan
                                @can('categoria-elementos.edit')
                                <td width="10">
                                    <a class="btn btn-success btn-xs" href="{{ route('categoria-elementos.edit',$categoria->id) }}">
                                        <span class="fa fa-edit">
                                        </span>
                                    </a>
                                </td>
                                @endcan
                                @can('categoria-elementos.destroy')
                                <td width="10">
                                    <form action="{{ route('categoria-elementos.destroy', $categoria->id) }}" class="form-inline" method="post">
                                        {{ csrf_field() }}
                                        <input name="_method" type="hidden" value="DELETE"/>
                                        <button class=" btn btn-danger btn-xs" type="submit">
                                            <span class="fa fa-trash">
                                            </span>
                                        </button>
                                    </form>
                                </td>
                                @endcan
                            </tr>
                            @endforeach --}}
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
        $datable=$('#categoria-elementos-table').DataTable({
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
            ajax: "categoria-elementos/listarCategorias/1",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nombre', name: 'nombre'},
                {data: 'descripcion', name: 'descripcion'},
                {data: 'action', name: 'action', orderable: true, searchable: true},
            ]
        });

        $("body").on("click", "#categoria-elementos-table #btnEliminar", function(event) {
            event.preventDefault();
            var r = confirm('¿Desea eliminar el registro? ¡Al eliminar este registro, se eliminaran todos los datos asociados al mismo!');
            if (r == true) {
                var idsele = $(this).attr("value");
                var token = $("#token").val();
                $.ajax({
                    url: 'categoria-elementos/'+idsele,
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

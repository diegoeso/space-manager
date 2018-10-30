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
                            Basurero
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover" id="basura-table">
                                <thead>
                                <tr>
                                    <th width="10">
                                    </th>
                                    <th width="200">
                                        De
                                    </th>
                                    <th>
                                        Asunto
                                    </th>
                                    <th width="80"></th>
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
            $datable = $('#basura-table').DataTable({
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
                ajax: "correo/basura/"+'{{ Auth::user()->email }}',
                columns: [
                    {data: 'leido', render:function ($leido) {
                        if($leido==0){
                            return '<i class="fa fa-star-o text-yellow"></i>'
                        }else
                        {
                            return '<i class="fa fa-star text-yellow"></i>'
                        }
                    }},
                    {data: 'de', name: 'de'},
                    {data: 'mensaje_res', name: 'mensaje_res'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action', orderable: true, searchable: true}
                ]
            });
        });
    </script>
@endsection

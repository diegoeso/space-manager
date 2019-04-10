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
            Espacios Academicos
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
                    <a class="btn btn-primary btn-sm" href="{{ route('espacios.create')}}">
                        <span class="fa fa-plus">
                        </span>
                        Nuevo
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="row" style="padding-bottom: 5px;">
                    <div class="col-md-12">
                        {!! Form::open(['route'=>'espacios.mostrar_estadisticas', 'method'=>'POST', 'class'=>'form-inline']) !!}
                        <div class="modal-body">
                            <input id="fechaI" name="fechaI" type="hidden">
                            </input>
                            <input id="fechaF" name="fechaF" type="hidden">
                            </input>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>
                                        Seleccione los espacios que desea consultar
                                    </label>
                                    {!! Form::select('espacio_e[]', $espaciosE, null, ['class'=>'form-control select2','multiple','id'=>'espacio_e','style'=>'width: 100%;','tabindex'=>'-1','required']) !!}
                                </div>
                                <div class="col-md-4">
                                    <label>
                                        Rango de fechas a consultar
                                    </label>
                                    {!! Form::text('rangoFechas', null, ['class'=>'form-control','id'=>'rangoFechas']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-default btn-block btn-sm" type="submit">
                                        Cerrar
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-primary btn-block btn-sm">
                                        Generar
                                    </button>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <a class="btn bg-navy margin btn-xs pull-right" href="{{ route('pdf.espacios') }}" target="_black">
                    <i class="fa fa-file-pdf-o">
                    </i>
                    Descargar PDF
                </a>
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="espacios-usados-table">
                        <thead>
                            <tr>
                                <th width="10">
                                    #
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
    $(document).ready(function () {
        $('#espacio_e').select2({
            placeholder:'Selecciona un Espacio Académico'
        });
         $('input[name="rangoFechas"]').daterangepicker({
            "locale": {
            "format": "YYYY-MM-DD",
            "separator": " - ",
            "applyLabel": "Guardar",
            "cancelLabel": "Cancelar",
            "fromLabel": "Desde",
            "toLabel": "Hasta",
            "customRangeLabel": "Personalizar",
            "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sa"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Setiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
            "firstDay": 1
        },
        opens: 'left',
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY'));
            $('#fechaI').val(start.format('DD-MM-YYYY'));
            $('#fechaF').val(end.format('DD-MM-YYYY'));
        });


        $datatable=$('#espacios-table').DataTable(
        {
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
        });
    });
</script>
@endsection

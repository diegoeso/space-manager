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
        <li>
            <a href="{{ route('actividades.index') }}">
                Calendario Escolar
            </a>
        </li>
        <li class="active">
            Nuevo
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            @include('general.botonNuevo',['modulo' => 'Nuevo Horario','ruta'=>''])
            {!! Form::open(['route'=>'actividades.store', 'method'=>'POST','files' => true ]) !!}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12" id="formulario">
                        @include('admins.actividades.fragmentos.form')
                    </div>
                    {{--
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-12" id="datosEspacio">
                            </div>
                            <div class="col-md-12" id="elementosEspacio">
                            </div>
                        </div>
                    </div>
                    --}}
                </div>
                {{--
                <button class="btn btn-success" id="add" name="add" type="button">
                    <i class="md md-add">
                    </i>
                    Agregar Elemento
                </button>
                --}}
                <div class="table-responsive" id="elementosAdicionales" name="elementosAdicionales">
                    <br/>
                    <table class="table table-striped" id="dynamic_field">
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer">
                <button class="btn btn-primary btn-rounded waves-effect waves-light m-b-5" type="submit">
                    <i class="md md-check">
                    </i>
                    Guardar
                </button>
                <a class="btn btn-danger btn-rounded waves-effect waves-light m-b-5" href="{{ route('solicitudes.index') }}">
                    <i class="md md-cancel">
                    </i>
                    Cancelar
                </a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/solicitudCreate.js') }}">
</script>
<script>
    $(function() {

        $('#diaSemana').select2();
        $('#idCarrera').select2();
        moment.locale('es');
        // $('input[name="rangoFechas"]').daterangepicker({
        //     "locale": {
        //     "format": "YYYY-MM-DD",
        //     "separator": " - ",
        //     "applyLabel": "Guardar",
        //     "cancelLabel": "Cancelar",
        //     "fromLabel": "Desde",
        //     "toLabel": "Hasta",
        //     "customRangeLabel": "Personalizar",
        //     "daysOfWeek": [
        //         "Do",
        //         "Lu",
        //         "Ma",
        //         "Mi",
        //         "Ju",
        //         "Vi",
        //         "Sa"
        //     ],
        //     "monthNames": [
        //         "Enero",
        //         "Febrero",
        //         "Marzo",
        //         "Abril",
        //         "Mayo",
        //         "Junio",
        //         "Julio",
        //         "Agosto",
        //         "Setiembre",
        //         "Octubre",
        //         "Noviembre",
        //         "Diciembre"
        //     ],
        //     "firstDay": 1
        // },
        // opens: 'left',
        // }, function(start, end, label) {
        //     console.log("A new date selection was made: " + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY'));
        //     $('#fechaI').val(start.format('DD-MM-YYYY'));
        //     $('#fechaF').val(end.format('DD-MM-YYYY'));
        // });
    });
</script>
@endsection

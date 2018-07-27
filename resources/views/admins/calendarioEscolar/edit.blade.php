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
        <li>
            <a href="{{ route('calendarios.index') }}">
                Solcitudes
            </a>
        </li>
        <li class="">
            Editar
        </li>
        <li class="active">
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            @include('general.botonNuevo', ['modulo' => 'Editar Solicitud','ruta'=>''])
            {!! Form::model($horario, ['route'=>['calendarios.update' ,$horario->id],'method'=>'PUT','files' => true ])!!}
            {{--
            <input hidden="" id="idSolicitud" name="idSolicitud" type="text" value="{{ $solicitud->id }}"/>
            <input hidden="" id="idEspacio" name="idEspacio" type="text" value="{{ $solicitud->espacio->nombre }}"/>
            <input hidden="" id="idEsp" name="idEsp" type="text" value="{{ $solicitud->espacio->id }}"/>
            --}}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12" id="formulario">
                        @include('admins.calendarioEscolar.fragmentos.form')
                    </div>
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
{{-- Ejecucion de script para tomar el valor de $solicitud->espaicio_id de la BD --}}
<script>
    $idArea = $('#area_id').val();
    $.ajax({
        url: '/admin/solicitudes/espacios/' + $idArea,
        type: 'GET',
        dataType: 'JSON',
        success: function(data) {
            console.log(data);
            $.each(data, function(i, item) {
                if (item.id == '{{ $horario->espacio_id }}') {
                    $('#espacio_id').append('<option selected value=' + item.id + '>' + item.nombre + '</option>');
                } else {
                    $('#espacio_id').append('<option value=' + item.id + '>' + item.nombre + '</option>');
                }
            });
        }
    });
</script>
<script src="{{ asset('js/solicitudEdit.js') }}" type="text/javascript">
</script>
@endsection

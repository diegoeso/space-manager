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
            <a href="{{ url('/inicio') }}">
                <i class="fa fa-dashboard">
                </i>
                Home
            </a>
        </li>
        <li>
            <a href="{{ route('solicitud-elementos.index') }}">
                Solicitud Elementos
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
            {!! Form::model($solicitud, ['route'=>['solicitud-elementos.update' ,$solicitud->id],'method'=>'PUT','files' => true ])!!}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-7" id="formulario">
                        @include('usuarios.solicitudesElementos.fragmentos.form')
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button class="btn btn-primary btn-rounded waves-effect waves-light m-b-5" type="submit">
                    <i class="md md-check">
                    </i>
                    Guardar
                </button>
                <a class="btn btn-danger btn-rounded waves-effect waves-light m-b-5" href="{{ route('solicitud-elementos.index') }}">
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
<script>
    $(document).ready(function() {
        var id=$('#categoria_id').val();
        $.ajax({
            url: '/admin/espacios/elementos/'+id+'',
            type: 'GET',
            dataType: 'JSON',
            success:function(data) {
                console.log(data);
                $.each(data, function(i, item) {
                    if (item.id == '{{ $solicitud->elemento_id }}') {
                        $('#elemento_id').append('<option selected value='+item.id+'>'+item.nombre+'</option>');
                    }else
                    {
                        $('#elemento_id').append('<option value='+item.id+'>'+item.nombre+'</option>');
                    }
                });
            }
        });
        $('#categoria_id').select2({
            placeholder: 'Selecciona una Categoria',
        });
        $('#elemento_id').select2({
            placeholder: 'Selecciona un Elemento',
        });

        $('#fecha').datepicker({
            format: 'dd-mm-yyyy',
            autoHide:true,
            autoPick:true,
            inline:true,
            language:'es-mx'
        });
        
        $('#horaInicio').timepicker({
            showMeridian:false,
            showSeconds:true,
        });
        $('#horaFin').timepicker({
            showMeridian:false,
            showSeconds:true,
        });

        $('#categoria_id').change(function(event){
            var id=$('#categoria_id').val();
            elementos(id);
        });
    });

    function elementos(id) 
    {
        $('#elemento_id').html('');
        $.ajax({
            url: '/admin/espacios/elementos/'+id+'',
            type: 'GET',
            dataType: 'JSON',
            success:function(data) {
                console.log(data);
                $.each(data, function(i, item) {
                    $('#elemento_id').append('<option value='+item.id+'>'+item.nombre+'</option>');
                });
            }
        })
    }
</script>
@endsection

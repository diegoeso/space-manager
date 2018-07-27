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
            <a href="{{ route('usuarios.index') }}">
                Usuarios
            </a>
        </li>
        <li class="">
            Editar
        </li>
        <li class="active">
            {{ $usuario->nombre }}
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            @include('general.botonNuevo', ['modulo' => 'Editar Usuarios','ruta'=>''])
            {!! Form::model($usuario, ['route'=>['usuarios.update' ,$usuario->id],'method'=>'PUT','files' => true ])!!}
            <div class="box-body">
                @include('admins.usuarios.fragmentos.form')
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('confirmacion', 'Tipo de Usuario') !!}
                            {!! Form::select('confirmacion',['1'=>'Activa','0'=>'Inactiva'],null, ['class'=>'form-control', 'placeholder'=>'Estado de la cuenta']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        {!! Form::label('foto', 'Fotografia Actual') !!}
                        <br/>
                        <img alt="" height="150" src="{{ Storage::url($usuario->foto) }}" width=""/>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button class="btn btn-primary btn-rounded waves-effect waves-light m-b-5" type="submit">
                    <i class="md md-check">
                    </i>
                    Guardar
                </button>
                <a class="btn btn-danger btn-rounded waves-effect waves-light m-b-5" href="{{ route('usuarios.index') }}">
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
        document.getElementById('oculto').style.display = 'none';
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection

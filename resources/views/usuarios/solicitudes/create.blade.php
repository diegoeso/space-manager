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
                Inicio
            </a>
        </li>
        <li>
            <a href="{{ route('solicitud.index') }}">
                Solicitudes
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
        <div class="box box-solid box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-pencil">
                    </i>
                    Registrar solicitud
                </h3>
                <div class="box-tools">
                    <a class="btn btn-link" href="{{ route('solicitud.index')}}">
                        <span class="fa fa-mail-reply">
                        </span>
                        Volver
                    </a>
                </div>
            </div>
            {!! Form::open(['route'=>'solicitud.store', 'method'=>'POST','files' => true ]) !!}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-7" id="formulario">
                        @include('usuarios.solicitudes.fragmentos.form')
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-12" id="datosEspacio">
                            </div>
                            <div class="col-md-12" id="elementosEspacio">
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success" id="add" name="add" type="button">
                    <i class="md md-add">
                    </i>
                    Agregar Elemento
                </button>
                <div class="table-responsive" id="elementosAdicionales" name="elementosAdicionales">
                    <br/>
                    <table class="table table-striped" id="dynamic_field">
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer">
                <button class="btn btn-primary btn-rounded waves-effect waves-light m-b-5" id="guardar" name="guardar" type="submit">
                    <i class="md md-check">
                    </i>
                    Guardar
                </button>
                <a class="btn btn-danger btn-rounded waves-effect waves-light m-b-5" href="{{ route('solicitud.index') }}">
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
@endsection

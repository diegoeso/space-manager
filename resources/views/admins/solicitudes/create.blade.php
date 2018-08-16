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
            <a href="{{ route('solicitudes.index') }}">
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
        <div class="box box-primary">
            @include('general.botonNuevo',['modulo' => 'Nueva Solicitud','ruta'=>''])
            {!! Form::open(['route'=>'solicitudes.store', 'method'=>'POST','files' => true ]) !!}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-7" id="formulario">
                        @include('admins.solicitudes.fragmentos.form')
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
                <div class="table-responsive" id="elementosAdicionales" name="elementosAdicionales">
                    <br/>
                    <table class="table" id="dynamic_field">
                        <tbody>
                            @include('admins.solicitudes.fragmentos.agregarElementos')
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
@endsection

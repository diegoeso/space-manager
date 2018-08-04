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
            <a href="{{ route('areas.index') }}">
                Áreas
            </a>
        </li>
        <li class="">
            Editar
        </li>
        <li class="active">
            {{ $area->nombre }}
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            @include('general.botonNuevo', ['modulo' => 'Editar Área','ruta'=>''])
            {!! Form::model($area, ['route'=>['areas.update' ,$area->id],'method'=>'PUT','files' => true ])!!}
            <div class="box-body">
                @include('admins.areas.fragmentos.form')
            </div>
            <div class="box-footer">
                <button class="btn btn-primary btn-rounded waves-effect waves-light m-b-5" type="submit">
                    <i class="fa fa-plus">
                    </i>
                    Guardar
                </button>
                <a class="btn btn-danger btn-rounded waves-effect waves-light m-b-5" href="{{ route('users.index') }}">
                    <i class="fa fa-remove">
                    </i>
                    Cancelar
                </a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    @endsection
</div>

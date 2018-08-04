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
            Ver
        </li>
        <li class="active">
            {{ $area->nombre }}
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">
                    Datos del Registro
                </h3>
                <div class="box-tools">
                    <a class="btn btn-success btn-sm" href="{{ route('areas.edit',$area->id) }}">
                        <i class="fa fa-edit">
                        </i>
                        Editar
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="nombre">
                            Nombre
                        </label>
                        <p class="lead" name="nombre">
                            {{ $area->nombre }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label for="email">
                            Encargado
                        </label>
                        <p class="text-capitalize lead" name="encargado">
                            {{ $area->responsables->nombreCompleto }}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="descripcion">
                            Descripción
                        </label>
                        <p class="lead" name="descripcion">
                            {{ $area->descripcion}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

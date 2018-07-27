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
            <a href="{{ route('categoria-elementos.index') }}">
                Categoria Elementos
            </a>
        </li>
        <li class="">
            Ver
        </li>
        <li class="active">
            {{ $categoria->nombre }}
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-8 col-md-offset-2">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Datos del Registro
                </h3>
                <div class="box-tools">
                    <a class="btn btn-success btn-sm" href="{{ route('categoria-elementos.edit',$categoria->id) }}">
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
                        <p class="text-capitalize" name="nombre">
                            {{ $categoria->nombre }}
                        </p>
                    </div>
                    {{--
                    <div class="col-md-6">
                        <label for="email">
                            Permisos
                        </label>
                        <p class="text-capitalize" name="encargado">
                            {{ $categoria->permisos }}
                        </p>
                    </div>
                    --}}
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="descripcion">
                            Descripción
                        </label>
                        <p class="text-capitalize" name="descripcion">
                            {{ $categoria->descripcion}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

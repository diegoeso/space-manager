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
            <a href="{{ route('elementos.index') }}">
                Elementos
            </a>
        </li>
        <li class="">
            Ver
        </li>
        <li class="active">
            {{ $elemento->nombre }}
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 ">
        <div class="box box-solid box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-list-ul">
                    </i>
                    Datos del elemento
                </h3>
                <div class="box-tools">
                    <a class="btn btn-link" href="{{ route('elementos.index')}}">
                        <span class="fa fa-mail-reply">
                        </span>
                        Volver
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="nombre">
                            Nombre
                        </label>
                        <p class="text-capitalize" name="nombre">
                            {{ $elemento->nombre }}
                        </p>
                    </div>
                    <div class="col-md-4">
                        <label for="email">
                            Numero de inventario
                        </label>
                        <p class="text-upercase" name="encargado">
                            {{ $elemento->numeroInventario }}
                        </p>
                    </div>
                    <div class="col-md-4">
                        <label for="email">
                            Categoría
                        </label>
                        <p class="text-capitalize" name="encargado">
                            {{ $elemento->categoriaElemento->nombre }}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="descripcion">
                            Descripción
                        </label>
                        <p class="" name="descripcion">
                            {{ $elemento->descripcion}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

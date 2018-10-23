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
                <a href="{{ route('espacios.index') }}">
                    Espacios Académicos
                </a>
            </li>
            <li class="">
                Ver
            </li>
            <li class="active">
                {{ $espacio->nombre }}
            </li>
        </ol>
    </section>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-solid box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="fa fa-list-ul">
                        </i>
                        Datos del espacio académico
                    </h3>
                    <div class="box-tools">
                        <a class="btn btn-link" href="{{ route('espacios.index')}}">
                        <span class="fa fa-mail-reply">
                        </span>
                            Volver
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="lead">
                                Información
                            </p>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="nombre">
                                        Nombre
                                    </label>
                                    <p class="text-capitalize" name="nombre">
                                        {{ $espacio->nombre }}
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <label for="area_id">
                                        Área
                                    </label>
                                    <p class="text-capitalize" name="area_id">
                                        {{ $espacio->area->nombre }}
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <label for="ubicacion">
                                        Ubicación
                                    </label>
                                    <p class="text-capitalize" name="ubicacion">
                                        {{ $espacio->ubicacion}}
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="descripcion">
                                        Descripción
                                    </label>
                                    <p class="text-capitalize text-justify" name="descripcion">
                                        {{ $espacio->descripcion}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @if($espacio->elementos()->count())
                            <div class="col-md-6">
                                <div class="col-md-12 table-responsive">
                                    <p class="lead">
                                        Elementos asociados al espacio
                                    </p>
                                    <table class="table">
                                        <tr>
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                Categoría
                                            </th>
                                            <th>
                                                Elemento
                                            </th>
                                            <th>
                                                Cantidad
                                            </th>
                                        </tr>
                                        <tbody>
                                        @foreach ($espacio->elementos as $elemento)
                                            <tr>
                                                <td>
                                                    {{ $elemento->pivot->id }}
                                                </td>
                                                <td>
                                                    {{ $elemento->categoriaElemento->nombre }}
                                                </td>
                                                <td>
                                                    {{ $elemento->nombre }}
                                                </td>
                                                <td>
                                                    {{ $elemento->pivot->cantidad }} Pzs
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            <div class="text-center hidden-xs" style="padding-top: 120px">
                                <p class="lead">Sin elementos asociados</p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="box-footer">
                    <a href="{{route ('espacios.edit',$espacio->id)}}" class="btn btn-success btn-sm">
                        <i class="fa fa-edit"></i>
                        Editar
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

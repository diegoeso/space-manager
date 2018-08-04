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
            Ver
        </li>
        <li class="active">
            {{ $usuario->nombre }}
        </li>
    </ol>
</section>
@endsection
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile usuario-header text-center">
                    <img alt="usuario profile picture" class="profile-usuario-img" height="150" src="{{ Storage::url($usuario->foto) }}" width="150">
                        <h3 class="profile-usuarioname text-center text-capitalize">
                            {{ $usuario->nombre .' '.$usuario->apellidoP }}
                        </h3>
                        <p class="text-muted text-center lead">
                            @if ($usuario->tipoCuenta==2)
                            Profesor
                            @else
                            Alumno
                            @endif
                        </p>
                        <div class="box-tools text-center">
                            <a class="btn btn-success btn-sm" href="{{ route('usuarios.edit',$usuario->id) }}">
                                <i class="fa fa-edit">
                                </i>
                                Editar
                            </a>
                        </div>
                    </img>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-list-ul">
                    </i>
                    <h3 class="box-title">
                        Datos del registro
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <dl>
                        <div class="row">
                            <div class="col-md-4">
                                <dt>
                                    Carrera
                                </dt>
                                <dd class="lead">
                                    {{$usuario->nombreCarrera($usuario->carrera)}}
                                </dd>
                            </div>
                            <div class="col-md-4">
                                <dt>
                                    Semestre
                                </dt>
                                <dd class="lead">
                                    {{ $usuario->nombreSemestre($usuario->semestre)}}
                                </dd>
                            </div>
                            <div class="col-md-4">
                                <dt>
                                    No. de Cuenta
                                </dt>
                                <dd class="lead">
                                    {{ $usuario->matricula }}
                                </dd>
                            </div>
                        </div>
                    </dl>
                    <dl>
                        <div class="row">
                            <div class="col-md-4">
                                <dt>
                                    Nombre
                                </dt>
                                <dd class="lead">
                                    {{$usuario->nombre}}
                                </dd>
                            </div>
                            <div class="col-md-4">
                                <dt>
                                    Apellido Paterno
                                </dt>
                                <dd class="lead">
                                    {{ $usuario->apellidoP }}
                                </dd>
                            </div>
                            <div class="col-md-4">
                                <dt>
                                    Apellido Materno
                                </dt>
                                <dd class="lead">
                                    {{ $usuario->apellidoM }}
                                </dd>
                            </div>
                        </div>
                    </dl>
                    <dl>
                        <div class="row">
                            <div class="col-md-4">
                                <dt>
                                    Correo Electronico
                                </dt>
                                <dd class="lead">
                                    {{$usuario->email}}
                                </dd>
                            </div>
                            <div class="col-md-4">
                                <dt>
                                    Telefono
                                </dt>
                                <dd class="lead">
                                    {{ $usuario->telefono }}
                                </dd>
                            </div>
                            <div class="col-md-4">
                                <dt>
                                    Nombre de Usuario
                                </dt>
                                <dd class="lead">
                                    {{ $usuario->nickname }}
                                </dd>
                            </div>
                        </div>
                    </dl>
                    <dl>
                        <div class="row">
                            <div class="col-md-4">
                                <dt>
                                    Tipo de Cuenta
                                </dt>
                                <dd class="lead">
                                    @switch($usuario->tipoCuenta)
                                        @case(1)
                                            Responsable de Area
                                            @break                                    
                                        @default
                                            Administrador
                                    @endswitch
                                </dd>
                            </div>
                            <div class="col-md-4">
                                <dt>
                                    Creacion de registro
                                </dt>
                                <dd class="text-capitalize lead">
                                    {{ $usuario->created_at->format('l j F Y') }}
                                </dd>
                            </div>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</section>
{{--
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title text-capitalize">
                    Datos del usuario
                    <em>
                        {{ $usuario->nombre }}
                    </em>
                </h3>
                <div class="box-tools">
                    <a class="btn btn-success btn-sm" href="{{ route('usuarios.edit',$usuario->id) }}">
                        <i class="fa fa-edit">
                        </i>
                        Editar
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="box-body box-profile">
                    <div class="row">
                        <div class="col-md-5">
                            <img alt="usuario profile picture" class="profile-usuario-img img-responsive img-rounded" src="{{ Storage::url($usuario->foto) }}"/>
                            <h3 class="profile-usuarioname text-center text-capitalize">
                                {{ $usuario->nombre }}
                            </h3>
                            <p class="text-muted text-center">
                                @switch($usuario->tipoCuenta)
                                @case(0)
                                    Administrador
                                    @break
                                @case(1)
                                    Responsable de Area
                                    @break
                                @case(2)
                                    Profesor
                                    @break
                                @case(3)
                                    Alumno
                                    @break
                                @default
                                        Default case...
                            @endswitch
                            </p>
                        </div>
                    </div>
                    @if ($usuario->carrera ||$usuario->semestre)
                    <div class="col-md-5">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <label>
                                    Carrera:
                                </label>
                                <b>
                                    {{ $usuario->carrera }}
                                </b>
                            </li>
                            <li class="list-group-item">
                                <label>
                                    Semestre:
                                </label>
                                <b>
                                    {{ $usuario->semestre }}
                                </b>
                            </li>
                            <li class="list-group-item">
                                <label>
                                    Numero de cuenta:
                                </label>
                                <b>
                                    {{ $usuario->matricula }}
                                </b>
                            </li>
                        </ul>
                    </div>
                    @endif
                    <div class="col-md-7">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <label>
                                    Nombre:
                                </label>
                                <b>
                                    {{ $usuario->nombreCompleto }}
                                </b>
                            </li>
                            <li class="list-group-item">
                                <label>
                                    Correo Electronico:
                                </label>
                                <b>
                                    {{ $usuario->email }}
                                </b>
                            </li>
                            <li class="list-group-item">
                                <label>
                                    Telefono:
                                </label>
                                <b>
                                    {{ $usuario->telefono }}
                                </b>
                            </li>
                            <li class="list-group-item">
                                <label>
                                    usuario name:
                                </label>
                                <b>
                                    {{ $usuario->nickname }}
                                </b>
                            </li>
                            <li class="list-group-item">
                                <label>
                                    Estado de la cuenta:
                                </label>
                                <b>
                                    @if ($usuario->confirmacion==1)
                                    <span class="label label-success">
                                        Activa
                                    </span>
                                    @else
                                    <span class="label label-danger">
                                        Inactiva
                                    </span>
                                    @endif
                                </b>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
--}}
@endsection

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
            <a href="{{ route('users.index') }}">
                Usuarios
            </a>
        </li>
        <li class="">
            Ver
        </li>
        <li class="active">
            {{ $user->nombre }}
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
                <div class="box-body box-profile user-header">
                    <img alt="User profile picture" class="profile-user-img user-image img-responsive" src="{{ Storage::url($user->foto) }}">
                        <h3 class="profile-username text-center text-capitalize">
                            {{ $user->nombre .' '.$user->apellidoP }}
                        </h3>
                        <p class="text-muted text-center">
                            @switch($user->tipoCuenta)
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
                        <div class="box-tools text-center">
                            <a class="btn btn-success btn-sm" href="{{ route('users.edit',$user->id) }}">
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
                                    Nombre
                                </dt>
                                <dd>
                                    {{$user->nombre}}
                                </dd>
                            </div>
                            <div class="col-md-4">
                                <dt>
                                    Apellido Paterno
                                </dt>
                                <dd>
                                    {{ $user->apellidoP }}
                                </dd>
                            </div>
                            <div class="col-md-4">
                                <dt>
                                    Apellido Materno
                                </dt>
                                <dd>
                                    {{ $user->apellidoM }}
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
                                <dd>
                                    {{$user->email}}
                                </dd>
                            </div>
                            <div class="col-md-4">
                                <dt>
                                    Telefono
                                </dt>
                                <dd>
                                    {{ $user->telefono }}
                                </dd>
                            </div>
                            <div class="col-md-4">
                                <dt>
                                    NickName
                                </dt>
                                <dd>
                                    {{ $user->nickname }}
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
                                <dd>
                                    @switch($user->tipoCuenta)
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
                                <dd class="text-capitalize">
                                    {{ $user->created_at->format('l j F Y') }}
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
                        {{ $user->nombre }}
                    </em>
                </h3>
                <div class="box-tools">
                    <a class="btn btn-success btn-sm" href="{{ route('users.edit',$user->id) }}">
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
                        <p class="text-capitalize" name="nickname">
                            {{ $user->nombreCompleto }}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <label for="nickname">
                            Usuario
                        </label>
                        <p class="" name="email">
                            {{ $user->nickname }}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="email">
                            Correo
                        </label>
                        <p class="" name="email">
                            {{ $user->email }}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <label for="tipoCuenta">
                            Tipo de Usuario
                        </label>
                        <p class="text-capitalize" name="tipoCuenta">
                            @if ($user->tipoCuenta==0)
                              Administrador
                            @else
                              Responsable de Area
                            @endif
                        </p>
                    </div>
                    <div class="col-md-3">
                        <label for="email">
                            Estado de la cuenta
                        </label>
                        <p class="text-capitalize" name="email">
                            @if ($user->confirmacion==1)
                            <span class="label label-success">
                                Activa
                            </span>
                            @else
                            <span class="label label-danger">
                                Inactiva
                            </span>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="email">
                            Fotografia
                        </label>
                        <br/>
                        <img alt="" height="180" src="{{ Storage::url($user->foto) }}" width=""/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
--}}
@endsection

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
                        <h4 class="profile-username text-center text-capitalize">
                            {{ $user->nombre .' '.$user->apellidoP }}
                        </h4>
                        <p class="text-muted text-center">
                            @switch($user->tipoCuenta)
                                @case(0)
                                    Administrador
                                    @break
                                @case(1)
                                    Responsable de Área
                                    @break
                                @case(2)
                                    Profesor
                                    @break
                                @case(3)
                                    Alumno
                                    @break

                                @default
                                    Usuario
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
            <div class="box box-solid box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="fa fa-list-ul">
                        </i>
                        Datos del usuario
                    </h3>
                    <div class="box-tools">
                        <a class="btn btn-link" href="{{ route('users.index')}}">
                            <span class="fa fa-mail-reply">
                            </span>
                            Volver
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <dl>
                        <div class="row">
                            <div class="col-md-4">
                                <dt>
                                    Nombre
                                </dt>
                                <dd class="">
                                    {{$user->nombre}}
                                </dd>
                            </div>
                            <div class="col-md-4">
                                <dt>
                                    Apellido Paterno
                                </dt>
                                <dd class="">
                                    {{ $user->apellidoP }}
                                </dd>
                            </div>
                            <div class="col-md-4">
                                <dt>
                                    Apellido Materno
                                </dt>
                                <dd class="">
                                    {{ $user->apellidoM }}
                                </dd>
                            </div>
                        </div>
                    </dl>
                    <hr/>
                    <dl>
                        <div class="row">
                            <div class="col-md-6">
                                <dt>
                                    Correo Electrónico
                                </dt>
                                <dd class="">
                                    {{$user->email}}
                                </dd>
                            </div>
                            <div class="col-md-6">
                                <dt>
                                    Teléfono
                                </dt>
                                <dd class="">
                                    {{ $user->telefono }}
                                </dd>
                            </div>
                        </div>
                    </dl>
                    <dl>
                        <div class="row">
                            <div class="col-md-6">
                                <dt>
                                    Nombre de Usuario
                                </dt>
                                <dd class="">
                                    {{ $user->nickname }}
                                </dd>
                            </div>
                            <div class="col-md-6">
                                <dt>
                                    Tipo de Cuenta
                                </dt>
                                <dd class="">
                                    @switch($user->tipoCuenta)
                                        @case(1)
                                            Responsable de Área
                                            @break
                                        @default
                                            Administrador
                                    @endswitch
                                </dd>
                            </div>
                        </div>
                    </dl>
                    <dl class="">
                      <div class="row">
                        <div class="col-md-6">
                            <dt>
                                Creación de registro
                            </dt>
                            <dd class="text-capitalize ">
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
@endsection

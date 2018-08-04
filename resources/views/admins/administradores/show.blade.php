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
                        <p class="text-muted text-center lead">
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
                                <dd class="lead">
                                    {{$user->nombre}}
                                </dd>
                            </div>
                            <div class="col-md-4">
                                <dt>
                                    Apellido Paterno
                                </dt>
                                <dd class="lead">
                                    {{ $user->apellidoP }}
                                </dd>
                            </div>
                            <div class="col-md-4">
                                <dt>
                                    Apellido Materno
                                </dt>
                                <dd class="lead">
                                    {{ $user->apellidoM }}
                                </dd>
                            </div>
                        </div>
                    </dl>
                    <dl>
                        <div class="row">
                            <div class="col-md-4">
                                <dt>
                                    Correo Electrónico
                                </dt>
                                <dd class="lead">
                                    {{$user->email}}
                                </dd>
                            </div>
                            <div class="col-md-4">
                                <dt>
                                    Teléfono
                                </dt>
                                <dd class="lead">
                                    {{ $user->telefono }}
                                </dd>
                            </div>
                            <div class="col-md-4">
                                <dt>
                                    Nombre de Usuario
                                </dt>
                                <dd class="lead">
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
                                <dd class="lead">
                                    @switch($user->tipoCuenta)
                                        @case(1)
                                            Responsable de Área
                                            @break                                    
                                        @default
                                            Administrador
                                    @endswitch
                                </dd>
                            </div>
                            <div class="col-md-4">
                                <dt>
                                    Creación de registro
                                </dt>
                                <dd class="text-capitalize lead">
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

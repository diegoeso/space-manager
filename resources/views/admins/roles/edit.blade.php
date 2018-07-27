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
            <a href="{{ route('roles.index') }}">
                Roles y Permisos
            </a>
        </li>
        <li class="">
            Editar
        </li>
        <li class="active">
            {{ $role->name }}
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            @include('general.botonNuevo', ['modulo' => 'Editar Roles y Permisos','ruta'=>''])
            <div class="panel-body">
                {!! Form::model($role, ['route' => ['roles.update', $role->id],
                    'method' => 'PUT']) !!}
                    @include('admins.roles.fragmentos.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @endsection
</div>

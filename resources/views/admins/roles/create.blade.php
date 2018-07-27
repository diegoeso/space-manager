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
        <li class="active">
            Nuevo
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            @include('general.botonNuevo',['modulo' => 'Roles y Permisos','ruta'=>''])
            <div class="panel-body">
                {{ Form::open(['route' => 'roles.store']) }}

                        @include('admins.roles.fragmentos.form')
                        
                    {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection

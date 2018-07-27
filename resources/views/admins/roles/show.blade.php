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
            Ver
        </li>
        <li class="active">
            {{ $role->name }}
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                Rol
            </div>
            <div class="panel-body">
                <p>
                    <strong>
                        Nombre:
                    </strong>
                    <br/>
                    {{ $role->name }}
                </p>
                <p>
                    <strong>
                        Slug:
                    </strong>
                    <br/>
                    {{ $role->slug }}
                </p>
                <p>
                    <strong>
                        Descripción:
                    </strong>
                    <br/>
                    {{ $role->description }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

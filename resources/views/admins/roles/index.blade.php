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
        <li class="active">
            Roles y Permisos
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            {{-- boton y texto de la parte superior de la tabla --}}
            @include('general.botonNuevo', ['modulo' => 'Roles y Permisos','ruta'=>'roles.create'])
            <div class="box-body">
                <div class="table-responsive">
                    @include('general.mensaje')
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="10px">
                                    ID
                                </th>
                                <th>
                                    Nombre
                                </th>
                                <th colspan="3">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td>
                                    {{ $role->id }}
                                </td>
                                <td>
                                    {{ $role->name }}
                                </td>
                                @can('roles.show')
                                <td width="10px">
                                    <a class="btn btn-sm btn-default" href="{{ route('roles.show', $role->id) }}">
                                        ver
                                    </a>
                                </td>
                                @endcan
                                @can('roles.edit')
                                <td width="10px">
                                    <a class="btn btn-sm btn-default" href="{{ route('roles.edit', $role->id) }}">
                                        editar
                                    </a>
                                </td>
                                @endcan
                                @can('roles.destroy')
                                <td width="10px">
                                    {!! Form::open(['route' => ['roles.destroy', $role->id], 
                                    'method' => 'DELETE']) !!}
                                    <button class="btn btn-sm btn-danger">
                                        Eliminar
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                                @endcan
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $roles->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        
    });
</script>
@endsection

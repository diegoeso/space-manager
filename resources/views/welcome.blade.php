@extends('layouts.app')
@section('content')
<div class="content">
    <div class="title m-b-md">
        Space Manager
    </div>
    <div class="links">
        <a href="{{ route('register') }}">
            Registro
        </a>
        <a href="{{ url('/inicio') }}">
            Eventos
        </a>
        <a href="{{ route('solicitud.create') }}">
            Solicitudes
        </a>
        <a href="{{ url('admin/login') }}">
            Administrativos
        </a>
    </div>
</div>
@endsection

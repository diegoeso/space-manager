@extends('layouts.app')
@section('content')
<div class="content">
    <div class="title m-b-md">
        Space Manager
    </div>
    <div class="links">
        <a href="#">
            Registro
        </a>
        <a href="{{ route('solicitud.index') }}">
            Eventos
        </a>
        <a href="#">
            Espacios Academicos
        </a>
        <a href="#">
            Calendarios
        </a>
    </div>
</div>
@endsection

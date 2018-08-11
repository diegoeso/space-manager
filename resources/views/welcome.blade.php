@extends('layouts.app')
@section('content')
<div class="content">
    {{--
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                    </div>
                    <div class="tab-pane" id="tab_2">
                    </div>
                    <div class="tab-pane" id="tab_3">
                    </div>
                </div>
            </div>
        </div>
    </div>
    --}}
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

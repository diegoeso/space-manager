@extends('layouts.admin')
@section('navegacion')
    <section class="content-header">
        <h1>
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
                URL no encontrada
            </li>
        </ol>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="error-page" style="padding-top: 80px">
            <h2 class="headline text-info" style="font-size: 60px;">
                <i class="fa fa-building">
                </i>
                403
            </h2>
            <div class="error-content" style="padding-top: 5px;">
                <h3 style="font-size: 30px">
                    <i class="fa fa-warning text-info">
                    </i>
                    Acción no autorizada.
                </h3>
                <p class="lead">
                    No tienes acceso a esta URL, consulta con el administrador del sistema.
                </p>
                <a class="btn btn-primary" href="{{ Request::root() }}/{{ Request::segment(1)}}">
                    <i class="fa fa-arrow-left">
                    </i>
                    Volver
                </a>
            </div>
        </div>
    </section>
@endsection

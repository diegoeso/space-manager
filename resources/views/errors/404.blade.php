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
        <h2 class="headline text-yellow" style="font-size: 80px;">
            <i class="fa fa-building">
            </i>
            404
        </h2>
        <div class="error-content" style="padding-top: 5px;">
            <h3 style="font-size: 30px">
                <i class="fa fa-warning text-yellow">
                </i>
                Oops! Pagina no encontrada.
            </h3>
            <p class="lead">
                La url que trata de consultar no existe o no se encuentra disponible en este momento.
            </p>
            <a class="btn btn-warning" href="{{ Request::root() }}/{{ Request::segment(1) }}/{{ Request::segment(2) }}">
                <i class="fa fa-arrow-left">
                </i>
                Volver
            </a>
        </div>
    </div>
</section>
@endsection

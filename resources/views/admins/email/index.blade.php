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
            Mensajes
        </li>
    </ol>
</section>
@endsection
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <a class="btn btn-primary btn-block margin-bottom" href="{{ route('mensajes.create') }}">
                Nuevo
            </a>
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Correo
                    </h3>
                    <div class="box-tools">
                        <button class="btn btn-box-tool" data-widget="collapse" type="button">
                            <i class="fa fa-minus">
                            </i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active">
                            <li class="">
                                <a aria-expanded="false" data-toggle="tab" href="#tab_1">
                                    <i class="fa fa-inbox">
                                    </i>
                                    Inbox
                                    <span class="label label-primary pull-right">
                                        {{ count($mensajes) }}
                                    </span>
                                </a>
                            </li>
                        </li>
                        <li>
                            <li class="">
                                <a aria-expanded="false" data-toggle="tab" href="#tab_2">
                                    <i class="fa fa-envelope-o">
                                    </i>
                                    Enviados
                                    <span class="label label-primary pull-right">
                                        {{ count($salida) }}
                                    </span>
                                </a>
                            </li>
                        </li>
                        {{--
                        <li>
                            <a href="#">
                                <i class="fa fa-trash-o">
                                </i>
                                Eliminados
                            </a>
                        </li>
                        --}}
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Inbox
                            </h3>
                            {{--
                            <div class="box-tools pull-right">
                                <div class="has-feedback">
                                    <input class="form-control input-sm" placeholder="Search Mail" type="text">
                                        <span class="glyphicon glyphicon-search form-control-feedback">
                                        </span>
                                    </input>
                                </div>
                            </div>
                            --}}
                        </div>
                        <div class="box-body no-padding">
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">
                                    <tbody>
                                        @foreach ($entrada as $mensaje)
                                        <tr>
                                            @if ($mensaje->leido==1)
                                            <td width="50">
                                                <i class="fa fa-check text-primary">
                                                </i>
                                                <i class="fa fa-check text-primary">
                                                </i>
                                            </td>
                                            @else
                                            <td width="50">
                                                <i class="fa fa-check">
                                                </i>
                                            </td>
                                            @endif
                                            <td>
                                                <a href="{{ route('mensajes.show', $mensaje->id) }}">
                                                    {{ $mensaje->nombreDe }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ $mensaje->asunto }}
                                            </td>
                                            <td>
                                                {{ $mensaje->created_at }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_2">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Enviados
                            </h3>
                            {{--
                            <div class="box-tools pull-right">
                                <div class="has-feedback">
                                    <input class="form-control input-sm" placeholder="Search Mail" type="text">
                                        <span class="glyphicon glyphicon-search form-control-feedback">
                                        </span>
                                    </input>
                                </div>
                            </div>
                            --}}
                        </div>
                        <div class="box-body no-padding">
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">
                                    <tbody>
                                        @foreach ($salida as $mensajeS)
                                        <tr>
                                            @if ($mensajeS->leido==1)
                                            <td width="50">
                                                <i class="fa fa-check text-primary">
                                                </i>
                                                <i class="fa fa-check text-primary">
                                                </i>
                                            </td>
                                            @else
                                            <td width="50">
                                                <i class="fa fa-check">
                                                </i>
                                            </td>
                                            @endif
                                            <td>
                                                <a href="{{ route('mensajes.show', $mensajeS->id) }}">
                                                    {{ $mensajeS->nombreDe }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ $mensajeS->asunto }}
                                            </td>
                                            <td>
                                                {{ $mensajeS->created_at }}
                                            </td>
                                            {{--
                                            <td width="10">
                                                <form action="{{ route('mensajes.destroy', $mensajeS->id) }}" class="form-inline" method="post">
                                                    {{ csrf_field() }}
                                                    <input name="_method" type="hidden" value="DELETE"/>
                                                    <button class=" btn btn-danger btn-xs" type="submit">
                                                        <span class="fa fa-trash">
                                                        </span>
                                                    </button>
                                                </form>
                                            </td>
                                            --}}
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{--
                    <div class="tab-pane" id="tab_3">
                    </div>
                    --}}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
</script>
@endsection

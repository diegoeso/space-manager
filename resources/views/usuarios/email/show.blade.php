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
            <a href="{{ url('/inicio') }}">
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
            <a class="btn btn-primary btn-block margin-bottom" href="{{ route('mensaje.create') }}">
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
                            <a href="{{ route('mensaje.index') }}">
                                <i class="fa fa-inbox">
                                </i>
                                Inbox
                                <span class="label label-primary pull-right">
                                    {{ count($mensajes) }}
                                </span>
                            </a>
                        </li>
                        {{--
                        <li>
                            <a href="#">
                                <i class="fa fa-envelope-o">
                                </i>
                                Enviados
                            </a>
                        </li>
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
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Mensaje
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-read-info">
                        <h3 class="text-capitalize">
                            {{-- Message Subject Is Placed Here --}}
                            {{ $mensaje[0]->asunto }}
                        </h3>
                        <h5>
                            De: {{ $mensaje[0]->email }}
                            <span class="mailbox-read-time pull-right">
                                {{ $mensaje[0]->created_at->format('l j F Y  H:i:s') }}
                            </span>
                        </h5>
                    </div>
                    <!-- /.mailbox-read-info -->
                    <div class="mailbox-controls with-border text-center">
                        <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-container="body" data-original-title="Responder" data-toggle="tooltip" href="{{ route('mensaje.responder',$mensaje[0]->id) }}" title="" type="button">
                                <i class="fa fa-reply">
                                </i>
                            </a>
                        </div>
                    </div>
                    <!-- /.mailbox-controls -->
                    <div class="mailbox-read-message">
                        <p>
                            {{ $mensaje[0]->mensaje }}
                        </p>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="pull-right">
                        <a class="btn btn-default" href="">
                            <i class="fa fa-trash-o">
                            </i>
                            Eliminar
                        </a>
                    </div>
                    <a class="btn btn-default" href="{{ route('mensaje.responder',$mensaje[0]->id) }}">
                        Responder
                    </a>
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

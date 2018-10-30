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
        @include('admins.email.fragmentos.correo_menu')
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Correo entrante
                    </h3>
                </div>
                <div class="box-body no-padding">
                    <div class="mailbox-read-info">
                        <h3>
                            {{ $mensaje->asunto }}
                        </h3>
                        <h5>
                            De: {{ $de->nombre }} ({{ $mensaje->de }})
                            <span class="mailbox-read-time pull-right">
                                {{ $mensaje->created_at->format('l j F Y - H:m:s A') }}
                            </span>
                        </h5>
                    </div>
                    <div class="mailbox-controls with-border text-center">
                        <div class="btn-group">
                            <button class="btn btn-default btn-sm" data-container="body" data-original-title="Eliminar" data-toggle="tooltip" title="" type="button">
                                <i class="fa fa-trash-o">
                                </i>
                            </button>
                            <a href="{{route('correo.responder',$mensaje->id)}}" class="btn btn-default btn-sm"
                               data-container="body"
                               data-original-title="Responder"
                               data-toggle="tooltip" title="" type="button">
                                <i class="fa fa-reply">
                                </i>
                            </a>
                        </div>
                    </div>
                    <div class="mailbox-read-message">
                        <p>
                            {{ $mensaje->mensaje }}
                        </p>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="pull-right">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-reply">
                            </i>
                            Responder
                        </button>
                    </div>
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-trash-o">
                        </i>
                        Delete
                    </button>
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

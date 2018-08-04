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
                        Compose New Message
                    </h3>
                </div>
                {!! Form::open(['route'=>'mensaje.store', 'method'=>'POST','files' => true ]) !!}
                <!-- /.box-header -->
                <div class="box-body">
                    @if (isset($mensaje))
                    <input id="solicitud_id" name="solicitud_id" type="hidden" value="{{ $mensaje->solicitud_id }}"/>
                    <input id="email" name="email" type="hidden" value="{{ $mensaje->email }}"/>
                    <input id="nombreAdmin" name="nombreAdmin" type="hidden" value="{{ $mensaje->nombreCompleto }}"/>
                    <input id="para" name="para" type="hidden" value="{{ $mensaje->id }}"/>
                    <input id="de" name="de" type="hidden" value="{{ Auth::user()->id }}"/>
                    @endif
                    <div class="form-group">
                        {!! Form::label('nombrePara', 'Para:', ['class'=>'form-label']) !!}
                        {!! Form::text('nombrePara', null, ['class'=>'form-control','placeholder'=>'Para','id'=>'nombrePara']) !!}
                    </div>
                    {{ Form::close() }}
                    <div class="form-group">
                        {!! Form::label('asunto', 'Asunto:', ['class'=>'form-label']) !!}
                        {!! Form::text('asunto', null, ['class'=>'form-control','placeholder'=>'Asunto']) !!}
                    </div>
                    @if (isset($mensaje))
                    <div class="form-group">
                        <label>
                            Mensaje entrante:
                        </label>
                        <p>
                            {{ $mensaje->mensaje }}
                        </p>
                    </div>
                    @endif
                    <div class="form-group">
                        {!! Form::label('mensaje', 'Mensaje:', ['class'=>'form-label']) !!}
                        {!! Form::textarea('mensaje', null, ['class'=>'form-control']) !!}
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="pull-right">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-envelope-o">
                                </i>
                                Enviar
                            </button>
                        </div>
                        <a class="btn btn-default" href="{{ route('mensaje.index') }}" type="reset">
                            <i class="fa fa-times">
                            </i>
                            Descartar
                        </a>
                    </div>
                </div>
                {!!Form::close() !!}
            </div>
        </div>
    </div>
</section>
<!-- /.box-footer -->
<!-- /. box -->
@endsection
@section('script')
<script>
    @if (isset($mensaje))
        $(document).ready(function() {
        var email = $('#email').val();
        var nombre = $('#nombreAdmin').val();
        $('#nombrePara').val(nombre+'  '+ '('+email+')');
        $('#nombrePara').attr('disabled','disabled');
    });    
    @endif
</script>
@endsection

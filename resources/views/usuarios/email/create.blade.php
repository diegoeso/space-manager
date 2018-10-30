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
            @include('usuarios.email.fragmentos.correo_menu')
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Nuevo Mensaje
                        </h3>
                    </div>
                {!! Form::open(['route'=>'mensaje.store', 'method'=>'POST','files' => true ]) !!}
                <!-- /.box-header -->
                    <div class="box-body">
                         @if (isset($mensaje))
                        <input id="solicitud_id" name="solicitud_id" type="hidden" value="{{ $mensaje->solicitud_id
                        }}"/>
                        <input id="email" name="email" type="hidden" value="{{ $mensaje->de }}"/>
                        <input id="nombreAdmin" name="nombreAdmin" type="hidden" value="{{ $user->FullName }}"/>
                        <input id="para" name="para" type="hidden" value="{{ $mensaje->de }}"/>
                        <input id="de" name="de" type="hidden" value="{{ $mensaje->para }}"/>
                        @endif
                        <div class="form-group">
                            {!! Form::label('para', 'Para:', ['class'=>'form-label']) !!}
                            {!! Form::text('para', null, ['class'=>'form-control','placeholder'=>'Para (email)',
                            'id'=>'nombrePara']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('asunto', 'Asunto:', ['class'=>'form-label']) !!}
                            {!! Form::text('asunto', null, ['class'=>'form-control','placeholder'=>'Asunto']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('mensaje', 'Mensaje:', ['class'=>'form-label']) !!}
                            {!! Form::textarea('mensaje', null, ['class'=>'form-control']) !!}
                        </div>
                         @if (isset($mensaje))
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Asunto: {{$mensaje->asunto}}</h3>
                                </div>
                                <div class="panel-body">
                                    Mensaje:
                                    <br>
                                    {{$mensaje->mensaje}}
                                </div>
                            </div>
                         @endif
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

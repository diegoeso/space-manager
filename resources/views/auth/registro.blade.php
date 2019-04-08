@extends('layouts.app')
@section('content')
<div class="register-box">
    <div class="register-logo">
        <a href="{{ url('/') }}">
            <b>
                Space
            </b>
            Manager
        </a>
    </div>
    <div class="register-box-body">
        <p class="lead text-center">
            <img src="{{ asset('img/register.png') }}" width="80px">
            </img>
            <br/>
            Registrarse
        </p>
        {!! Form::open(['route'=>'register', 'method'=>'POST','files' => true ]) !!}
        {!!Form::text('tipoCuenta', null, ['id'=>'tipoCuenta']) !!}
        <div class="row">
            <div class="col-md-12">
                <div class="form-group has-feedback">
                    {{-- {!! Form::label('nombre', 'Nombre') !!} --}}
                {!! Form::text('nombre', null, ['class'=>'form-control', 'placeholder' => 'Nombre (s)']) !!}
                    <span class="glyphicon glyphicon-user form-control-feedback">
                    </span>
                    @if ($errors->has('nombre'))
                    <span class="label label-danger">
                        <strong>
                            {{ $errors->first('nombre') }}
                        </strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group has-feedback">
                    {!! Form::text('apellidoP', null, ['class'=>'form-control', 'placeholder' => 'Apellido Paterno']) !!}
                    <span class="glyphicon glyphicon-user form-control-feedback">
                    </span>
                    @if ($errors->has('apellidoP'))
                    <span class="label label-danger">
                        <strong>
                            {{ $errors->first('apellidoP') }}
                        </strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group has-feedback">
                    {!! Form::text('apellidoM', null, ['class'=>'form-control', 'placeholder' => 'Apellido Materno']) !!}
                    <span class="glyphicon glyphicon-user form-control-feedback">
                    </span>
                    @if ($errors->has('apellidoM'))
                    <span class="label label-danger">
                        <strong>
                            {{ $errors->first('apellidoM') }}
                        </strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group has-feedback">
                    {{-- {!! Form::label('email', 'Correo Electronico') !!} --}}
                {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Correo Electronico Institucional','id'=>'email']) !!}
                    <span class="glyphicon glyphicon-envelope form-control-feedback">
                    </span>
                    @if ($errors->has('email'))
                    <span class="label label-danger">
                        <strong>
                            {{ $errors->first('email') }}
                        </strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group has-feedback">
                    {{-- {!! Form::label('password', 'Contraseña') !!} --}}
                {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Contraseña','id'=>'password']) !!}
                    <span class="glyphicon glyphicon-lock form-control-feedback" id="password" name="password">
                    </span>
                    @if ($errors->has('password'))
                    <span class="label label-danger">
                        <strong>
                            {{ $errors->first('password') }}
                        </strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group has-feedback">
                    {{-- {!! Form::label('password_confirmation', 'Confirmar Contraseña') !!} --}}
                {!! Form::password('password_confirmation', ['class'=>'form-control', 'placeholder'=>'Confirmar Contraseña']) !!}
                    <span class="glyphicon glyphicon-lock form-control-feedback" id="password1" name="password1">
                    </span>
                    @if ($errors->has('password_confirmation'))
                    <span class="label label-danger">
                        <strong>
                            {{ $errors->first('password_confirmation') }}
                        </strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary btn-rounded waves-effect waves-light m-b-5 btn-block" id="registro" name="registro" type="submit">
                    <i class="md md-check">
                    </i>
                    Únete ahora
                </button>
            </div>
        </div>
        {!! Form::close() !!}
        <a class="text-center" href="{{ route('login') }}">
            Ya eres miembro
        </a>
    </div>
    <!-- /.form-box -->
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        // $('#tipoCuenta').val(3);
        $('#email').keypress(function(){
            $res=$('#email').val()
            console.log($res);
        });
        $('#password').focus(function() {
            $res=$('#email').val()
            if($res.indexOf("alumno.uaemex.mx") > -1)
            {
                $('#tipoCuenta').val('3');
                console.log($('#tipoCuenta').val());
            }else{
                if($res.indexOf("uaemex.mx") > -1){
                    $('#tipoCuenta').val('2')
                    console.log($('#tipoCuenta').val());
                }
            }
        });
    });
</script>
@endsection

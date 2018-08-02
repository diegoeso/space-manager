@extends('layouts.app')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="{{ url('/') }}"><b>Space</b>Manager</a>
  </div>

  <div class="login-box-body">
    <div class="text-center">
        <img src="{{ asset('img/user.png') }}" width="100">
    </div>
    <p class="login-box-msg">Inicia Sesión</p>

    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf

        <div class="form-group has-feedback">
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Correo Electronico">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group has-feedback">
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Contraseña">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>


        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Recordarme') }}
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-block">
                    Entrar
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    ¿Olvidaste tu contraseña?
                </a>
            </div>
            <div class="col-md-6">
                <a href="" class="btn btn-link">Profesor / Alumno</a>
            </div>
        </div>
    </form>
  </div>
</div>
@endsection

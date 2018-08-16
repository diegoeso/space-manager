@extends('layouts.app')
@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('/') }}">
            <b>
                Space
            </b>
            Manager
        </a>
    </div>
    <div class="login-box-body">
        <div class="text-center">
            <i class="fa fa-lock" style="font-size: 55px; color: #3c8dbc;">
            </i>
        </div>
        <p class="login-box-msg lead">
            Restablecer Contraseña
        </p>
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="form-group row">
                <div class="col-md-12">
                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" placeholder="Correo Electronico" required="" type="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>
                                {{ $errors->first('email') }}
                            </strong>
                        </span>
                        @endif
                    </input>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <input class="form-control" id="telefono" name="telefono" placeholder="Teléfono" type="text" value="{{ old('telefono') }}">
                        @if ($errors->has('telefono'))
                        <span class="invalid-feedback">
                            <strong>
                                {{ $errors->first('telefono') }}
                            </strong>
                        </span>
                        @endif
                    </input>
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-12 offset-md-4">
                    <button class="btn btn-primary btn-block" type="submit">
                        {{ __('Restablecer Contraseña') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

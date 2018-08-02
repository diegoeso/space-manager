@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Reset Password') }}
                </div>
                <div class="card-body">
                    <form action="{{ route('password.request') }}" method="POST">
                        @csrf
                        <input name="token" type="hidden" value="{{ $token }}">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="email">
                                    {{ __('E-Mail Address') }}
                                </label>
                                <div class="col-md-6">
                                    <input autofocus="" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" required="" type="email" value="{{ $email ?? old('email') }}">
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
                                <label class="col-md-4 col-form-label text-md-right" for="password">
                                    {{ __('Password') }}
                                </label>
                                <div class="col-md-6">
                                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" required="" type="password">
                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>
                                                {{ $errors->first('password') }}
                                            </strong>
                                        </span>
                                        @endif
                                    </input>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="password-confirm">
                                    {{ __('Confirm Password') }}
                                </label>
                                <div class="col-md-6">
                                    <input class="form-control" id="password-confirm" name="password_confirmation" required="" type="password">
                                    </input>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button class="btn btn-primary" type="submit">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </input>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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
        <li class="">
            Perfil
        </li>
        <li class="active">
            {{ $user->nombre .' '.$user->apellidoP }}
        </li>
    </ol>
</section>
@endsection
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile user-header">
                    <img alt="User profile picture" class="profile-user-img user-image img-responsive" src="{{ Storage::url($user->foto) }}">
                        {{--
                        <img alt="User Image" class="user-image" src="{{ Storage::url(Auth::user()->foto) }}">
                            --}}
                            <h3 class="profile-username text-center text-capitalize">
                                {{ $user->nombre .' '.$user->apellidoP }}
                            </h3>
                            <p class="text-muted text-center">
                                @switch($user->tipoCuenta)
                                @case(0)
                                    Administrador
                                    @break
                                @case(1)
                                    Responsable de Area
                                    @break
                                @case(2)
                                    Profesor
                                    @break
                                @case(3)
                                    Alumno
                                    @break

                                @default
                                        Default case...
                            @endswitch
                            </p>
                            @if ($user->carrera)
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <label>
                                        Carrera:
                                    </label>
                                    <b>
                                        {{ $usuario->carrera }}
                                    </b>
                                </li>
                                <li class="list-group-item">
                                    <label>
                                        Semestre:
                                    </label>
                                    <b>
                                        {{ $usuario->semestre }}
                                    </b>
                                </li>
                                <li class="list-group-item">
                                    <label>
                                        Numero de cuenta:
                                    </label>
                                    <b>
                                        {{ $usuario->matricula }}
                                    </b>
                                </li>
                            </ul>
                            @endif
                        </img>
                    </img>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box box-primary">
                {!! Form::model($user, ['route'=>['admin.perfil.update' ,$user->id],'method'=>'PUT','files' => true ])!!}
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('nombre', 'Nombre') !!}
                                {!! Form::text('nombre', null, ['class'=>'form-control text-capitalize', 'placeholder' => 'Nombre (s)']) !!}
                                @if ($errors->has('nombre'))
                                <span class="label label-danger">
                                    <strong>
                                        {{ $errors->first('nombre') }}
                                    </strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('apellidoP', 'Apellido Paterno') !!}
                                {!! Form::text('apellidoP', null, ['class'=>'form-control text-capitalize', 'placeholder' => 'Apellido Paterno']) !!}
                                @if ($errors->has('apellidoP'))
                                <span class="label label-danger">
                                    <strong>
                                        {{ $errors->first('apellidoP') }}
                                    </strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('apellidoM', 'Apellido Materno') !!}
                                {!! Form::text('apellidoM', null, ['class'=>'form-control text-capitalize', 'placeholder' => 'Apellido Materno']) !!}
                                @if ($errors->has('apellidoM'))
                                <span class="label label-danger">
                                    <strong>
                                        {{ $errors->first('apellidoM') }}
                                    </strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('email', 'Correo Electronico') !!}
                                {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Correo Electronico']) !!}
                                 @if ($errors->has('email'))
                                <span class="label label-danger">
                                    <strong>
                                        {{ $errors->first('email') }}
                                    </strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('telefono', 'Teléfono') !!}
                                {!! Form::text('telefono', null, ['class'=>'form-control text-capitalize', 'placeholder' => 'Teléfono']) !!}
                                @if ($errors->has('telefono'))
                                <span class="label label-danger">
                                    <strong>
                                        {{ $errors->first('telefono') }}
                                    </strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('nickname', 'Nombre de Usuario') !!}
                                {!! Form::text('nickname', null, ['class'=>'form-control', 'placeholder' => 'Usuario','id'=>'nickname']) !!}
                                @if ($errors->has('nickname'))
                                <span class="label label-danger">
                                    <strong>
                                        {{ $errors->first('nickname') }}
                                    </strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('password', 'Contraseña') !!}
                                {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Contraseña']) !!}
                                @if ($errors->has('password'))
                                <span class="label label-danger">
                                    <strong>
                                        {{ $errors->first('password') }}
                                    </strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('password_confirmation', 'Confirmar Contraseña') !!}
                                {!! Form::password('password_confirmation', ['class'=>'form-control', 'placeholder'=>'Confirmar Contraseña']) !!}
                                @if ($errors->has('password_confirmation'))
                                <span class="label label-danger">
                                    <strong>
                                        {{ $errors->first('password_confirmation') }}
                                    </strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('foto', 'Fotografia') !!}
                                <br/>
                                {{--         {!! Form::file('foto', ['class'=>'form-control']) !!} --}}
                                <input class="form-control" name="foto" onchange="readURL(this);" type="file"/>
                                @if ($errors->has('foto'))
                                <span class="label label-danger">
                                    <strong>
                                        {{ $errors->first('foto') }}
                                    </strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <img alt="" id="blah" src="" width="200px"/>
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::label('foto', 'Fotografia Actual') !!}
                            <br/>
                            <img alt="" height="150" src="{{ Storage::url($user->foto) }}" width=""/>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-primary btn-rounded waves-effect waves-light m-b-5" type="submit">
                        <i class="md md-check">
                        </i>
                        Guardar
                    </button>
                    <a class="btn btn-danger btn-rounded waves-effect waves-light m-b-5" href="{{ url('/admin') }}">
                        <i class="md md-cancel">
                        </i>
                        Cancelar
                    </a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection

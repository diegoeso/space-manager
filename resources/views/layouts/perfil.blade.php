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
            <a href="{{ url('/inicio') }}">
                <i class="fa fa-dashboard">
                </i>
                Home
            </a>
        </li>
        <li class="active">
            Perfil
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
                <div class="box-body box-profile">
                    @if ($usuario->tipoCuenta==0 || $usuario->tipoCuenta==1)
                    <img alt="User profile picture" class="profile-user-img img-responsive" src="{{ Auth::user()->foto ? Storage::url(Auth::user()->foto) : asset('img/userA.png') }}">
                        @else
                        <img alt="User profile picture" class="profile-user-img img-responsive" src="{{ Auth::user()->foto ? Storage::url(Auth::user()->foto) : asset('img/user.png') }}">
                            @endif
                            <h3 class="profile-username text-center text-capitalize">
                                {{ $usuario->nombre .' '.$usuario->apellidoP }}
                            </h3>
                            <p class="text-muted text-center">
                                {{ $usuario->tipoCuenta($usuario->tipoCuenta) }}
                            </p>
                            @if ($usuario->carrera)
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <label>
                                        Carrera:
                                    </label>
                                    <b>
                                        {{ $usuario->nombreCarrera($usuario->carrera) }}
                                    </b>
                                </li>
                                <li class="list-group-item">
                                    <label>
                                        Semestre:
                                    </label>
                                    <b>
                                        {{ $usuario->nombreSemestre($usuario->semestre) }}
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
                {!! Form::model($usuario, ['route'=>['perfil.update' ,$usuario->id],'method'=>'PUT','files' => true ])!!}
                <div class="box-body">
                    @include('admins.usuarios.fragmentos.form')
                    <div class="row">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::label('foto', 'Fotografia Actual') !!}
                            <br/>
                            <img alt="" height="150" src="{{ Storage::url($usuario->foto) }}" width=""/>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-primary btn-rounded waves-effect waves-light m-b-5" type="submit">
                        <i class="md md-check">
                        </i>
                        Guardar
                    </button>
                    <a class="btn btn-danger btn-rounded waves-effect waves-light m-b-5" href="{{ route('usuarios.index') }}">
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
    $('#foto').hidden();
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

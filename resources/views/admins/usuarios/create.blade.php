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
        <li>
            <a href="{{ route('usuarios.index') }}">
                Usuarios
            </a>
        </li>
        <li class="active">
            Nuevo
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            @include('general.botonNuevo',['modulo' => 'Nuevo Usuarios','ruta'=>''])
            {!! Form::open(['route'=>'usuarios.store', 'method'=>'POST','files' => true ]) !!}
            <div class="box-body">
                {!!Form::hidden('tipoCuenta', null, ['id'=>'tipoCuenta']) !!}
                    @include('admins.usuarios.fragmentos.form')
            </div>
            <div class="box-footer">
                <button class="btn btn-primary btn-rounded waves-effect waves-light m-b-5" type="submit">
                    <i class="fa fa-plus">
                    </i>
                    Guardar
                </button>
                <a class="btn btn-danger btn-rounded waves-effect waves-light m-b-5" href="{{ route('users.index') }}">
                    <i class="fa fa-remove">
                    </i>
                    Cancelar
                </a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#email').keypress(function(){
            $res=$('#email').val()
            console.log($res);
        });
        $('#password').focus(function() {
            $res=$('#email').val()
            // console.log($res);
            if($res.indexOf("alumno.uaemex.mx") > -1)
            {
                // console.log('alumno');
                $('#tipoCuenta').val('3');
                console.log($('#tipoCuenta').val());

            }else{
                if($res.indexOf("uaemex.mx") > -1){
                    // console.log('profesor');
                    $('#tipoCuenta').val('2')
                    console.log($('#tipoCuenta').val());
                }
            }
        });
    });

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

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
        <li>
            <a href="{{ route('usuarios.index') }}">
                Usuarios
            </a>
        </li>
        <li class="active">
            Nuevo registro
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                  <i class="fa fa-pencil"></i>
                    Registrar usuario
                </h3>
                <div class="box-tools">
                    <a class="btn btn-link" href="{{ route('usuarios.index')}}">
                        <span class="fa fa-mail-reply">
                        </span>
                        Volver
                    </a>
                </div>
            </div>
            {!! Form::open(['route'=>'usuarios.store', 'method'=>'POST','files' => true ]) !!}
            <div class="box-body">
                {!!Form::hidden('tipoCuenta', null, ['id'=>'tipoCuenta']) !!}
                    @include('admins.usuarios.fragmentos.form')
            </div>
            <div class="box-footer">
                <button class="btn btn-primary btn-rounded waves-effect waves-light m-b-5" id="guardar" name="guardar" type="submit">
                    <i class="fa fa-plus">
                    </i>
                    Guardar
                </button>
                <a class="btn btn-danger btn-rounded waves-effect waves-light m-b-5" href="{{ route('usuarios.index') }}">
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

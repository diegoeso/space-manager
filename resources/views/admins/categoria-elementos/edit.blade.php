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
            <a href="{{ route('categoria-elementos.index') }}">
                Categorías de Elementos
            </a>
        </li>
        <li class="">
            Editar
        </li>
        <li class="active">
            {{ $categoria->nombre }}
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
                  <i class="fa fa-edit"></i>
                    Editar categoría
                </h3>
                <div class="box-tools">
                    <a class="btn btn-link" href="{{ route('categoria-elementos.index')}}">
                        <span class="fa fa-mail-reply">
                        </span>
                        Volver
                    </a>
                </div>
            </div>
            {!! Form::model($categoria, ['route'=>['categoria-elementos.update' ,$categoria->id],'method'=>'PUT','files' => true ])!!}
            <div class="box-body">
                @include('admins.categoria-elementos.fragmentos.form')
            </div>
            <div class="box-footer">
                <button class="btn btn-primary btn-rounded waves-effect waves-light m-b-5" type="submit" name="guardar" id="guardar">
                    <i class="md md-check">
                    </i>
                    Guardar
                </button>
                <a class="btn btn-danger btn-rounded waves-effect waves-light m-b-5" href="{{ route('categoria-elementos.index') }}">
                    <i class="md md-cancel">
                    </i>
                    Cancelar
                </a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    @endsection
</div>

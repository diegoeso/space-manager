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
            <a href="{{ route('calendarios.index') }}">
                Horarios
            </a>
        </li>
        <li class="">
            Ver
        </li>
        <li class="active">
            Horario
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <div class="user-block">
                            <span class="username">
                                <a class="text-capitalize" href="#">
                                    {{ $horario->actividadAcademica }} - Clase
                                </a>
                            </span>
                            <span class="description">
                                {{ $horario->espacio->nombre }}
                                    -
                                    {{ $horario->fechaInicio->format('l j F Y') }}
                                <div class="pull-right">
                                    {{ $horario->created_at->diffForHumans() }}
                                </div>
                            </span>
                        </div>
                        <div class="box-tools">
                            <a class="btn btn-box-tool" data-original-title="Editar Registro" data-toggle="tooltip" href="{{ route('calendarios.edit',$horario->id) }}" title="" type="button">
                                <i class="fa fa-edit">
                                </i>
                            </a>
                            <button class="btn btn-box-tool" data-widget="collapse" type="button">
                                <i class="fa fa-minus">
                                </i>
                            </button>
                            <a class="btn btn-box-tool" data-original-title="Cerrar" data-toggle="tooltip" href="{{ route('calendarios.index') }}" type="button">
                                <i class="fa fa-times">
                                </i>
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <strong>
                                        Materia:
                                    </strong>
                                    <p class="" id="actividadAcademica">
                                        {{ $horario->actividadAcademica }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <strong>
                                        Docente:
                                    </strong>
                                    <p class="text-capitalize" id="docente">
                                        {{ $horario->docente }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <strong>
                                        Horario:
                                    </strong>
                                    <p class="" id="horario">
                                        {{ $horario->horaInicio }} a {{ $horario->horaFin }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <strong>
                                        Fecha:
                                    </strong>
                                    <p class="" id="fechaInicio">
                                        {{ $horario->fechaInicio->format('l j F Y') }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <strong>
                                        Carrera:
                                    </strong>
                                    <p class="" id="carrera">
                                        {{ $horario->nombreCarrera($horario->carrera) }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <strong>
                                        Semestre
                                    </strong>
                                    <p class="" id="semestre">
                                        {{ $horario->nombreSemestre($horario->semestre) }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <strong>
                                        Grupo:
                                    </strong>
                                    <p class="" id="grupo">
                                        {{ $horario->grupo }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <strong>
                                        Espacio Academico
                                    </strong>
                                    <p class="" id="espacio">
                                        {{ $horario->espacio->nombre }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

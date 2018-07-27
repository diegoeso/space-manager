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
            <a href="{{ url('/inicio') }}">
                <i class="fa fa-dashboard">
                </i>
                Home
            </a>
        </li>
        <li>
            <a href="{{ route('solicitud-elementos.index') }}">
                Solicitudes
            </a>
        </li>
        <li class="">
            Ver
        </li>
        <li class="active">
            {{ $solicitud->elemento->nombre }}
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-md-7">
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <div class="user-block ">
                            <img alt="User Image" class="img-circle" src="{{ Storage::url($solicitud->solicitante->foto) }}">
                                <span class="username">
                                    <a href="#">
                                        {{ $solicitud->solicitante->nombre .' '.$solicitud->solicitante->apellidoP .' '. $solicitud->solicitante->apellidoM}}
                                    </a>
                                </span>
                                <span class="description">
                                    <strong>
                                        {{ $solicitud->elemento->nombre .' - '.$solicitud->categoria->nombre }}
                                    </strong>
                                    -
                                    {{ $solicitud->fecha->format('l j F Y') }}
                                    <div class="pull-right">
                                        {{ $solicitud->created_at->diffForHumans() }}
                                    </div>
                                </span>
                            </img>
                        </div>
                        <div class="box-tools">
                            <a class="btn btn-box-tool" data-original-title="Editar Registro" data-toggle="tooltip" href="{{ route('solicitud-elementos.edit',$solicitud->id) }}" title="" type="button">
                                <i class="fa fa-edit">
                                </i>
                            </a>
                            <button class="btn btn-box-tool" data-widget="collapse" type="button">
                                <i class="fa fa-minus">
                                </i>
                            </button>
                            <a class="btn btn-box-tool" data-original-title="Cerrar" data-toggle="tooltip" href="{{ route('solicitud-elementos.index') }}" type="button">
                                <i class="fa fa-times">
                                </i>
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                        {{--
                        <p class="lead">
                            {{ $solicitud->espacio->nombre }}
                        </p>
                        --}}
                        <div class="row">
                            <div class="col-md-8">
                                <p class="lead text-capitalize">
                                    {{ $solicitud->elemento->nombre .' - '.$solicitud->categoria->nombre }}
                                </p>
                            </div>
                            <div class="col-md-4" style="padding-top: 8px;">
                                @switch($solicitud->estado)
                                @case(0)
                                <span class="label label-info pull-right">
                                    Pendiente
                                </span>
                                @break
                                @case(1)
                                <span class="label label-success pull-right">
                                    Aceptada
                                </span>
                                @break
                                @case(2)
                                <span class="label label-warning pull-right">
                                    Rechazada
                                </span>
                                @break
                                @case(3)
                                <span class="label label-danger pull-right">
                                    Cancelada
                                </span>
                                @break
                                @case(4)
                                <span class="label pull-right" style="background-color:#d2d6de ">
                                    Finalizada
                                </span>
                                @break
                            @endswitch
                            </div>
                        </div>
                        <p>
                            <div class="row ">
                                <div class="col-md-6">
                                    <strong>
                                        Fecha de inicio:
                                    </strong>
                                    <br/>
                                    <p class="">
                                        {{ $solicitud->fecha->format('l j F Y') }}
                                    </p>
                                </div>
                            </div>
                        </p>
                        <p>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>
                                        Hora de inicio:
                                    </strong>
                                    <br/>
                                    {{ $solicitud->horaInicio}}
                                </div>
                                <div class="col-md-6">
                                    <strong>
                                        Hora de termino:
                                    </strong>
                                    <br/>
                                    {{ $solicitud->horaFin }}
                                </div>
                            </div>
                        </p>
                        <p>
                            {{ $solicitud->actividadAcademica }}
                        </p>
                        <div class="row">
                            <div class="col-md-4">
                                <a class="btn btn-danger btn-xs" href="{{ route('solicitud-elementos.cancelar',$solicitud->id) }}">
                                    <i class="fa fa-trash">
                                    </i>
                                    Cancelar Solicitud
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
            $('#btnCerrar').click(function(event){
            document.getElementById("formEvaluacion").reset();
            $('#modalEvaluacion').modal('hide'); 
        });
    });
</script>
@endsection

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
                        {{--
                        <div class="row">
                            <div class="col-md-3 col-xs-6 col-sm-3" style="margin-top: 5px">
                                <a class="btn btn-success btn-xs btn-block" href="{{ route('solicitudes-elementos.aprobar', $solicitud->id) }}" type="button">
                                    <i class="fa fa-check-square-o">
                                    </i>
                                    Aprobar
                                </a>
                            </div>
                            <div class="col-md-3 col-xs-6 col-sm-3" style="margin-top: 5px">
                                <button class="btn btn-warning btn-xs btn-block" data-target="#rechazar" data-toggle="modal" type="button">
                                    <i class="fa fa-close">
                                    </i>
                                    Rechazar
                                </button>
                            </div>
                            <div class="col-md-3 col-xs-6 col-sm-3" style="margin-top: 5px">
                                <button class="btn btn-danger btn-xs btn-block" data-target="#cancelar" data-toggle="modal" type="button">
                                    <i class="fa fa-trash">
                                    </i>
                                    Cancelar
                                </button>
                            </div>
                            <div class="col-md-3 col-xs-6 col-sm-3" style="margin-top: 5px">
                                <button class="btn btn-info btn-xs btn-block" data-target="#mensaje" data-toggle="modal" type="button">
                                    <i class="fa fa-send">
                                    </i>
                                    Notificar
                                </button>
                            </div>
                        </div>
                        --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Cancelar Solicitud -->
<div aria-labelledby="myModalLabel" class="modal fade" id="cancelar" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Cancelar Solicitud
                </h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route'=>['solicitudes.cancelar' ,$solicitud->id],'method'=>'PUT'])!!}
                <div class="form-group">
                    {!! Form::label('motivo', 'Motivo de la Cancelacion', ['class'=>'control-label']) !!}
                    {!! Form::textArea('motivo', null, ['class'=>'form-control','placeholder'=>'Motivo por el cual la solicitud es cancelada','size' => '30x4','id'=>'motivo']) !!}
                </div>
                <button class="btn btn-danger btn-block" type="submit">
                    <i class="fa fa-trash">
                    </i>
                    Cancelar Solicitud
                </button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- Modal Rechazar Solicitud-->
<div aria-labelledby="myModalLabel" class="modal fade" id="rechazar" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Rechazar Solicitud
                </h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route'=>['solicitudes.rechazar' ,$solicitud->id],'method'=>'PUT'])!!}
                <div class="form-group">
                    {!! Form::label('motivo', 'Motivo del rechazo', ['class'=>'control-label']) !!}
                    {!! Form::textArea('motivo', null, ['class'=>'form-control','placeholder'=>'Motivo por el cual la solicitud es rechazada','size' => '30x4']) !!}
                </div>
                <button class="btn btn-warning btn-block" type="submit">
                    <i class="fa fa-close">
                    </i>
                    Rechazar Solicitud
                </button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- Modal Enviar Notificacion -->
<div aria-labelledby="myModalLabel" class="modal fade" id="mensaje" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Enviar Mensaje
                </h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route'=>['mensajes.store'],'method'=>'POST'])!!}
                <div class="form-group">
                    {!! Form::text('solicitud_id',$solicitud->id)  !!}
                    {!! Form::text('de', Auth::user()->id) !!}
                    {!! Form::text('para', $solicitud->solicitante->id) !!}
                    {!! Form::label('asunto', 'Asunto', ['class'=>'control-label']) !!}
                    {!! Form::text('asunto', null, ['class'=>'form-control','placeholder'=>'Asunto']) !!}
                    {!! Form::label('mensaje', 'Mensaje', ['class'=>'control-label']) !!}
                    {!! Form::textArea('mensaje', null, ['class'=>'form-control','placeholder'=>'Redacte aquí su mensaje','size' => '30x4']) !!}
                </div>
                <button class="btn btn-info btn-block" type="submit">
                    <i class="fa fa-send">
                    </i>
                    Enviar Mensaje
                </button>
                {!! Form::close() !!}
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

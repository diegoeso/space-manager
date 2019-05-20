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
            <a href="{{ route('solicitudes.index') }}">
                Solicitudes
            </a>
        </li>
        <li class="active">
            Ver
        </li>
    </ol>
</section>
@endsection
@section('content')
@if ($bandera==0)
<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-md-7">
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <div class="user-block">
                            <img alt="User Image" class="img-circle" src="{{ Storage::url($solicitud->tipoUsuario($solicitud)
                            ->foto) }}">
                                <span class="username">
                                    @switch($solicitud->tipoUsuario)
                                        @case(0)
                                            Administrador
                                            @break
                                        @case(1)
                                            Responsable de Área
                                            @break
                                        @case(2)
                                            Profesor
                                            @break
                                        @case(3)
                                            Alumno
                                            @break
                                        @default
                                             Usuario
                                    @endswitch
                                    <a href="">
                                        @switch($solicitud->tipoUsuario)
                                        @case(0)
                                            {{$solicitud->tipoUsuario($solicitud)->fullName}}
                                            @break
                                        @case(1)
                                            {{$solicitud->tipoUsuario($solicitud)->fullName}}
                                                @break
                                        @default
                                            {{$solicitud->tipoUsuario($solicitud)->fullName}}
                                    @endswitch
                                    </a>
                                </span>
                                <span class="description">
                                    {{ $solicitud->espacio->nombre }}
                                    -
                                    {{ $solicitud->fechaInicio->format('l j F Y') }}
                                    <div class="pull-right">
                                        {{ $solicitud->created_at->diffForHumans() }}
                                    </div>
                                </span>
                            </img>
                            <br/>
                            @foreach ($total as $el)
                            @if ($el->evaluado==$solicitud->usuarioSolicitud)
                            <div class="progress-group">
                                <span class="progress-text">
                                    Puntuación del usuario
                                </span>
                                <span class="progress-number">
                                    <b>
                                        @php
                                            $barra=$el->calificacion($el->evaluado) * 100 / 4;
                                        @endphp
                                        {{ $barra }}
                                    </b>
                                    /100
                                </span>
                                @php
                                    $barra=$el->calificacion($el->evaluado) * 100 / 4;
                                @endphp
                                <div class="progress sm">
                                    <div class="progress-bar progress-bar-aqua" style="width: {{ $barra }}%">
                                    </div>
                                </div>
                            </div>
                            @break
                            @endif
                            @endforeach
                        </div>
                        <div class="box-tools">
                            <a class="btn btn-box-tool" data-original-title="Editar Registro" data-toggle="tooltip" href="{{ route('solicitudes.edit',$solicitud->id) }}" title="" type="button">
                                <i class="fa fa-edit">
                                </i>
                            </a>
                            <button class="btn btn-box-tool" data-widget="collapse" type="button">
                                <i class="fa fa-minus">
                                </i>
                            </button>
                            <a class="btn btn-box-tool" data-original-title="Cerrar" data-toggle="tooltip" href="{{ route('solicitudes.index') }}" type="button">
                                <i class="fa fa-times">
                                </i>
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="lead">
                                    {{ $solicitud->espacio->nombre }}
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
                        <div class="row">
                            <div class="col-md-6">
                                <p>
                                    <strong>
                                        Fecha de inicio:
                                    </strong>
                                    <br/>
                                    {{ $solicitud->fechaInicio->format('l j F Y') }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <strong>
                                        Fecha de termino:
                                    </strong>
                                    <br/>
                                    {{ $solicitud->fechaFin->format('l j F Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>
                                    <strong>
                                        Hora de inicio:
                                    </strong>
                                    <br/>
                                    {{ $solicitud->horaInicio}}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <strong>
                                        Hora de termino:
                                    </strong>
                                    <br/>
                                    {{ $solicitud->horaFin }}
                                </p>
                            </div>
                        </div>
                        <p>
                            <strong>
                                Actividad Académica:
                            </strong>
                            <br/>
                            {{ $solicitud->actividadAcademica }}
                        </p>
                        @if ($solicitud->estado !=3)
                        <div class="row">
                            @if (!$solicitud->estado==1)
                            @can('solicitudes.confirmar')
                            <div class="col-md-3 col-xs-6 col-sm-3" style="margin-top: 5px">
                                <a class="btn btn-success btn-xs btn-block" href="{{ route('solicitudes.aprobar', $solicitud->id) }}" type="button">
                                    <i class="fa fa-check-square-o">
                                    </i>
                                    Aprobar
                                </a>
                            </div>
                            @endcan        
                            @endif
                            @can('solicitudes.rechazar')
                            <div class="col-md-3 col-xs-6 col-sm-3" style="margin-top: 5px">
                                <button class="btn btn-warning btn-xs btn-block" data-target="#rechazar" data-toggle="modal" type="button">
                                    <i class="fa fa-close">
                                    </i>
                                    Rechazar
                                </button>
                            </div>
                            @endcan
                            @can('solicitudes.cancelar')
                            <div class="col-md-3 col-xs-6 col-sm-3" style="margin-top: 5px">
                                <button class="btn btn-danger btn-xs btn-block" data-target="#cancelar" data-toggle="modal" type="button">
                                    <i class="fa fa-trash">
                                    </i>
                                    Cancelar
                                </button>
                            </div>
                            @endcan
                           
                            @can('solicitudes.notificar')
                            @if ($solicitud->tipoUsuario==2 ||$solicitud->tipoUsuario==3)
                            <div class="col-md-3 col-xs-6 col-sm-3" style="margin-top: 5px">
                                <button class="btn btn-info btn-xs btn-block" data-target="#mensaje" data-toggle="modal" type="button">
                                    <i class="fa fa-send">
                                    </i>
                                    Notificar
                                </button>
                            </div>
                            @endif
                            @endcan
                            <br/>
                            <br/>
                            <div class="col-md-12" style="padding-bottom: 5px;">
                                <a class="btn bg-navy margin btn-xs pull-right" href="{{ route('pdf.solicitud', $solicitud->id) }}" target="_black">
                                    <i class="fa fa-file-pdf-o">
                                    </i>
                                    Descargar PDF
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <div class="user-block">
                            Elementos Solicitados Adicionalmente
                        </div>
                        <div class="box-tools">
                            <button class="btn btn-box-tool" data-widget="collapse" type="button">
                                <i class="fa fa-minus">
                                </i>
                            </button>
                            <button class="btn btn-box-tool" data-original-title="Rechazar" data-toggle="tooltip" data-widget="remove" type="button">
                                <i class="fa fa-times">
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        @foreach ($solicitud->elementosSolicitud as $elemento)
                        <strong>
                            Categoría:
                        </strong>
                        {{ $elemento->categoriaElemento->nombre }}
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-capitalize">
                                    <strong>
                                        Elemento:
                                    </strong>
                                    {{ $elemento->nombre }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-capitalize">
                                    <strong>
                                        Cantidad:
                                    </strong>
                                    {{ $elemento->pivot->cantidad }} piezas
                                </p>
                            </div>
                            <hr/>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @if ($solicitud->estado==3)
        <div class="row">
            <div class="col-md-7">
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <p class="lead">
                            Motivo de la
                            <span class="text-danger">
                                cancelacion
                            </span>
                        </p>
                        <p>
                            @if ($solicitud->motivo)
                                {{ $solicitud->motivo }}
                            @else
                            Sin motivo
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endif
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
                    {!! Form::label('motivo', 'Motivo de la Cancelación', ['class'=>'control-label']) !!}
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
                    {!! Form::label('motivo', 'Motivo del Rechazo', ['class'=>'control-label']) !!}
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
                {!! Form::open(['route'=>['correo.store'],'method'=>'POST'])!!}
                <div class="form-group">
                    {!! Form::hidden('solicitud_id',$solicitud->id)  !!}
                    {!! Form::hidden('de', Auth::user()->id) !!}
                    {!! Form::hidden('para_email', $solicitud->tipoUsuario($solicitud)->email) !!}
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
@else

@foreach ($solicitudesPendientes as $solicitud)
<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-md-7">
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <div class="user-block">
                            {{-- {{ $solicitud->area->nombre }} --}}
                            <img alt="User Image" class="img-circle" src="{{ Storage::url
                            ($solicitud->tipoUsuario($solicitud)->foto) }}">
                                <span class="username">
                                    @switch($solicitud->tipoUsuario)
                                        @case(0)
                                            Administrador
                                            @break
                                        @case(1)
                                            Responsable de Área
                                            @break
                                        @case(2)
                                            Profesor
                                            @break
                                        @case(3)
                                            Alumno
                                            @break
                                        @default
                                             Usuario
                                    @endswitch
                                    <a class="text-capitalize" href="#">
                                        @switch($solicitud->tipoUsuario)
                                        @case(0)
                                            {{$solicitud->tipoUsuario($solicitud)->fullName}}
                                            @break
                                        @case(1)
                                            {{$solicitud->tipoUsuario($solicitud)->fullName}}
                                            @break
                                        @default
                                        {{$solicitud->tipoUsuario($solicitud)->fullName}}
                                    @endswitch
                                    </a>
                                </span>
                                <span class="description">
                                    {{ $solicitud->espacio->nombre }}
                                    -
                                    {{ $solicitud->fechaInicio->format('l j F Y') }}
                                    <div class="pull-right">
                                        {{ $solicitud->created_at->diffForHumans() }}
                                    </div>
                                </span>
                            </img>
                            @foreach ($total as $el)
                            @if ($el->evaluado==$solicitud->usuarioSolicitud)
                            <div class="progress-group">
                                <span class="progress-text">
                                    Puntuación del usuario
                                </span>
                                <span class="progress-number">
                                    <b>
                                        @php
                                            $barra=$el->calificacion($el->evaluado) * 100 / 4;

                                        @endphp
                                        {{ $barra }}
                                    </b>
                                    /100
                                </span>
                                @php
                                    $barra=$el->calificacion($el->evaluado) * 100 / 4;
                                @endphp
                                <div class="progress sm">
                                    <div class="progress-bar progress-bar-aqua" style="width: {{ $barra }}%">
                                    </div>
                                </div>
                            </div>
                            @break
                            @endif
                            @endforeach
                        </div>
                        <div class="box-tools">
                            <button class="btn btn-box-tool" data-widget="collapse" type="button">
                                <i class="fa fa-minus">
                                </i>
                            </button>
                            <a class="btn btn-box-tool" data-original-title="Cerrar" data-toggle="tooltip" href="{{ route('solicitudes.index') }}" type="button">
                                <i class="fa fa-times">
                                </i>
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="lead">
                                    {{ $solicitud->espacio->nombre }}
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
                        <div class="row">
                            <div class="col-md-6">
                                <p>
                                    <strong>
                                        Fecha de inicio:
                                    </strong>
                                    <br/>
                                    {{ $solicitud->fechaInicio->format('l j F Y') }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <strong>
                                        Fecha de termino:
                                    </strong>
                                    <br/>
                                    {{ $solicitud->fechaFin->format('l j F Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>
                                    <strong>
                                        Hora de inicio:
                                    </strong>
                                    <br/>
                                    {{ $solicitud->horaInicio}}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <strong>
                                        Hora de termino:
                                    </strong>
                                    <br/>
                                    {{ $solicitud->horaFin }}
                                </p>
                            </div>
                        </div>
                        <p>
                            <strong>
                                Actividad Académica:
                            </strong>
                            <br/>
                            {{ $solicitud->actividadAcademica }}
                        </p>
                        @if ($solicitud->estado !=4)
                        <div class="row">
                            {{-- btn aprobar --}}
                            @if (!$solicitud->estado==1)
                            @can('solicitudes.confirmar')
                            <div class="col-md-3 col-xs-6 col-sm-3" style="margin-top: 5px">
                                <a class="btn btn-success btn-xs btn-block" href="{{ route('solicitudes.aprobar', $solicitud->id) }}" type="button">
                                    <i class="fa fa-check-square-o">
                                    </i>
                                    Aprobar
                                </a>
                            </div>
                            @endcan        
                            @endif
                            
                            {{-- btn rechazar --}}
                            @can('solicitudes.rechazar')
                            <div class="col-md-3 col-xs-6 col-sm-3" style="margin-top: 5px">
                                <button class="btn btn-warning btn-xs btn-block" data-target="#rechazar" data-toggle="modal" type="button">
                                    <i class="fa fa-close">
                                    </i>
                                    Rechazar
                                </button>
                            </div>
                            @endcan
                            {{-- btn Cancelar --}}
                            @can('solicitudes.cancelar')
                            <div class="col-md-3 col-xs-6 col-sm-3" style="margin-top: 5px">
                                <button class="btn btn-danger btn-xs btn-block" data-target="#cancelar" data-toggle="modal" type="button">
                                    <i class="fa fa-trash">
                                    </i>
                                    Cancelar
                                </button>
                            </div>
                            @endcan
                           
                            {{-- btn notificar --}}
                            @can('solicitudes.notificar', Model::class)
                            <div class="col-md-3 col-xs-6 col-sm-3" style="margin-top: 5px">
                                <button class="btn btn-info btn-xs btn-block" data-target="#mensaje" data-toggle="modal" type="button">
                                    <i class="fa fa-send">
                                    </i>
                                    Notificar
                                </button>
                            </div>
                            @endcan
                            <div class="col-md-12" style="padding-bottom: 5px;">
                                <a class="btn bg-navy margin btn-xs pull-right" href="{{ route('pdf.solicitud', $solicitud->id) }}" target="_black">
                                    <i class="fa fa-file-pdf-o">
                                    </i>
                                    Descargar PDF
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <div class="user-block">
                            Elementos Solicitados Adicionalmente
                        </div>
                        <div class="box-tools">
                            <button class="btn btn-box-tool" data-widget="collapse" type="button">
                                <i class="fa fa-minus">
                                </i>
                            </button>
                            <button class="btn btn-box-tool" data-original-title="Rechazar" data-toggle="tooltip" data-widget="remove" type="button">
                                <i class="fa fa-times">
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        @foreach ($solicitud->elementosSolicitud as $elemento)
                        <strong>
                            Categoría:
                        </strong>
                        {{ $elemento->categoriaElemento->nombre }}
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-capitalize">
                                    <strong>
                                        Elemento:
                                    </strong>
                                    {{ $elemento->nombre }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-capitalize">
                                    <strong>
                                        Cantidad:
                                    </strong>
                                    {{ $elemento->pivot->cantidad }} piezas
                                </p>
                            </div>
                            <hr/>
                        </div>
                        @endforeach
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
                    {!! Form::label('motivo', 'Motivo de la Cancelación', ['class'=>'control-label']) !!}
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
                {!! Form::open(['route'=>['correo.store'],'method'=>'POST'])!!}
                <div class="form-group">
                    {!! Form::hidden('solicitud_id',$solicitud->id)  !!}
                    {!! Form::hidden('de', Auth::user()->email) !!}
                    {!! Form::hidden('para_email', $solicitud->solicitante->email) !!}
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
@endforeach
@endif
@endsection

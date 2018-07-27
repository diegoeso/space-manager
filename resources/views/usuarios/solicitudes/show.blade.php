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
            <a href="{{ route('solicitud.index') }}">
                Solicitudes
            </a>
        </li>
        <li class="">
            Ver
        </li>
        <li class="active">
            {{ $solicitud->espacio->nombre }}
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
                                        {{ $solicitud->espacio->nombre }}
                                    </strong>
                                    -
                                    {{ $solicitud->fechaInicio->format('l j F Y') }}
                                    <div class="pull-right">
                                        {{ $solicitud->created_at->diffForHumans() }}
                                    </div>
                                </span>
                            </img>
                        </div>
                        <div class="box-tools">
                            <a class="btn btn-box-tool" data-original-title="Editar Registro" data-toggle="tooltip" href="{{ route('solicitud.edit',$solicitud->id) }}" title="" type="button">
                                <i class="fa fa-edit">
                                </i>
                            </a>
                            <button class="btn btn-box-tool" data-widget="collapse" type="button">
                                <i class="fa fa-minus">
                                </i>
                            </button>
                            <a class="btn btn-box-tool" data-original-title="Cerrar" data-toggle="tooltip" href="{{ route('solicitud.index') }}" type="button">
                                <i class="fa fa-times">
                                </i>
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="collapse" id="collapseExample">
                            {{--
                            <div class="well">
                                --}}
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
                                <div class="callout callout-warning">
                                    <h4>
                                        <strong>
                                            Estado:
                                        </strong>
                                        <br/>
                                        Rechazada
                                    </h4>
                                    <p>
                                        <strong>
                                            Motivo:
                                        </strong>
                                        <br/>
                                        {{ $solicitud->motivo }}
                                    </p>
                                </div>
                                @break
                                @case(3)
                                <div class="callout callout-danger">
                                    <h4>
                                        <strong>
                                            Estado:
                                        </strong>
                                        <br/>
                                        Cancelada
                                    </h4>
                                    <p>
                                        <strong>
                                            Motivo:
                                        </strong>
                                        <br/>
                                        {{ $solicitud->motivo }}
                                    </p>
                                </div>
                                @break
                                @case(4)
                                <span class="label pull-right" style="background-color:#d2d6de ">
                                    Finalizada
                                </span>
                                @break
                            @endswitch
                            {{--
                            </div>
                            --}}
                        </div>
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
                                {{--
                                <a aria-controls="collapseExample" aria-expanded="false" class="label label-success pull-right" data-toggle="collapse" href="#collapseExample" role="button">
                                    Aprobada
                                </a>
                                --}}
                                <span class="label label-success pull-right">
                                    Aceptada
                                </span>
                                @break
                                @case(2)
                                <a aria-controls="collapseExample" aria-expanded="false" class="label label-warning pull-right" data-toggle="collapse" href="#collapseExample" role="button">
                                    Rechazada
                                </a>
                                {{--
                                <span class="label label-warning pull-right">
                                    Rechazada
                                </span>
                                --}}
                                @break
                                @case(3)
                                <a aria-controls="collapseExample" aria-expanded="false" class="label label-danger pull-right" data-toggle="collapse" href="#collapseExample" role="button">
                                    Cancelada
                                </a>
                                {{--
                                <span class="label label-danger pull-right">
                                    Cancelada
                                </span>
                                --}}
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
                                        {{ $solicitud->fechaInicio->format('l j F Y') }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <strong>
                                        Fecha de termino:
                                    </strong>
                                    <br/>
                                    <p class="">
                                        {{ $solicitud->fechaFin->format('l j F Y') }}
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
                                @if (!$solicitud->estado==2 || !$solicitud->estado==3)
                                <!-- Button trigger modal -->
                                <button class="btn btn-danger btn-xs" data-target="#myModal" data-toggle="modal" type="button">
                                    <i class="fa fa-trash">
                                    </i>
                                    Cancelar Solicitud
                                </button>
                                @endif
                            </div>
                            @if ($solicitud->estado==1)
                            <div class="col-md-4 pull-right">
                                <button class="btn btn-info btn-xs btn-block" data-target="#modalEvaluacion" data-toggle="modal" type="button">
                                    <i class="fa fa-check-square-o">
                                    </i>
                                    Evaluar
                                </button>
                            </div>
                            @endif
                        </div>
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
                            Categoria:
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
<!-- Modal -->
<div aria-labelledby="myModalLabel" class="modal fade" data-backdrop="static" data-keyboard="false" id="myModal" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header label-danger">
                <h4 class="modal-title" id="myModalLabel">
                    <i class="fa fa-calendar-times-o">
                    </i>
                    Cancelar Solicitud
                </h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route'=>'solicitud.cancelar']) !!}
                {!! Form::hidden('solicitud_id', $solicitud->id) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('motivo', 'Motivo por la cual cancela la solicitud.') !!}
                            {!! Form::textArea('motivo', null, ['class'=>'form-control', 'placeholder'=>'Motivo','id'=>'motivo','size' => '30x4']) !!}
                            @if ($errors->has('motivo'))
                            <span class="label label-danger">
                                <strong>
                                    {{ $errors->first('motivo') }}
                                </strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-primary btn-rounded waves-effect waves-light m-b-5" type="submit">
                        <i class="md md-check">
                        </i>
                        Guardar
                    </button>
                    <button class="btn btn-default" data-dismiss="modal" type="button">
                        Cancelar
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- Modal Evaluacion-->
<div aria-labelledby="myModalLabel" class="modal fade" data-backdrop="static" data-keyboard="false" id="modalEvaluacion" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header label-info">
                <h4 class="modal-title" id="myModalLabel">
                    <i class="fa fa-check-square-o">
                    </i>
                    Evaluación
                </h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route'=>'evaluaciones.store','method'=>'POST','id' => 'formEvaluacion' ])!!}
                @if ($evaluacion)
                {!!Form::hidden('idE', $evaluacion->id) !!}
                @endif
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    Punto
                                </th>
                                <th class="text-center">
                                    Malo
                                </th>
                                <th class="text-center">
                                    Regural
                                </th>
                                <th class="text-center">
                                    Bueno
                                </th>
                                <th class="text-center">
                                    Excelente
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Puntualidad
                                </td>
                                <td class="text-center">
                                    <input name="cal1" type="radio" value="1">
                                    </input>
                                </td>
                                <td class="text-center">
                                    <input name="cal1" type="radio" value="2">
                                    </input>
                                </td>
                                <td class="text-center">
                                    <input name="cal1" type="radio" value="3">
                                    </input>
                                </td>
                                <td class="text-center">
                                    <input name="cal1" type="radio" value="4">
                                    </input>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Limpieza
                                </td>
                                <td class="text-center">
                                    <input name="cal2" type="radio" value="1">
                                    </input>
                                </td>
                                <td class="text-center">
                                    <input name="cal2" type="radio" value="2">
                                    </input>
                                </td>
                                <td class="text-center">
                                    <input name="cal2" type="radio" value="3">
                                    </input>
                                </td>
                                <td class="text-center">
                                    <input name="cal2" type="radio" value="4">
                                    </input>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Atencion
                                </td>
                                <td class="text-center">
                                    <input name="cal3" type="radio" value="1">
                                    </input>
                                </td>
                                <td class="text-center">
                                    <input name="cal3" type="radio" value="2">
                                    </input>
                                </td>
                                <td class="text-center">
                                    <input name="cal3" type="radio" value="3">
                                    </input>
                                </td>
                                <td class="text-center">
                                    <input name="cal3" type="radio" value="4">
                                    </input>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Cumplio con la actividad
                                    <br/>
                                    a realizar
                                </td>
                                <td class="text-center">
                                    <input name="cal4" type="radio" value="1">
                                    </input>
                                </td>
                                <td class="text-center">
                                    <input name="cal4" type="radio" value="2">
                                    </input>
                                </td>
                                <td class="text-center">
                                    <input name="cal4" type="radio" value="3">
                                    </input>
                                </td>
                                <td class="text-center">
                                    <input name="cal4" type="radio" value="4">
                                    </input>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Condicion de los elementos
                                    <br/>
                                    solicitados (en caso de haber
                                    <br/>
                                    solicitado)
                                </td>
                                <td class="text-center">
                                    <input name="cal5" type="radio" value="1">
                                    </input>
                                </td>
                                <td class="text-center">
                                    <input name="cal5" type="radio" value="2">
                                    </input>
                                </td>
                                <td class="text-center">
                                    <input name="cal5" type="radio" value="3">
                                    </input>
                                </td>
                                <td class="text-center">
                                    <input name="cal5" type="radio" value="4">
                                    </input>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <button class="btn btn-primary btn-rounded waves-effect waves-light m-b-5" type="submit">
                        <i class="md md-check">
                        </i>
                        Guardar
                    </button>
                    <button class="btn btn-danger btn-rounded waves-effect waves-light m-b-5" id="btnCerrar" type="button">
                        <i class="md md-cancel">
                        </i>
                        Cancelar
                    </button>
                </div>
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

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
                Inicio
            </a>
        </li>
        <li class="active">
            <a>
                Dashboard
            </a>
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="col-lg-4 col-xs-12">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        {{ count($solicitudes) }}
                    </h3>
                    <p>
                        Tus Solicitudes
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-calendar-check-o">
                    </i>
                </div>
                <a class="small-box-footer" href="{{ route('solicitud.index') }}">
                    Más información
                    <i class="fa fa-arrow-circle-right">
                    </i>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>
                        {{ count($evaluaciones) }}
                    </h3>
                    <p>
                        Evaluaciones
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-star">
                    </i>
                </div>
                <a class="small-box-footer" href="{{ route('evaluaciones.index') }}">
                    Más información
                    <i class="fa fa-arrow-circle-right">
                    </i>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        {{ count($mensajes) }}
                    </h3>
                    <p>
                        Mensajes
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-envelope">
                    </i>
                </div>
                <a class="small-box-footer" href="{{ route('mensaje.index') }}">
                    Más información
                    <i class="fa fa-arrow-circle-right">
                    </i>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Evaluación
                </h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" type="button">
                        <i class="fa fa-minus">
                        </i>
                    </button>
                    <button class="btn btn-box-tool" data-widget="remove" type="button">
                        <i class="fa fa-times">
                        </i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="chart">
                            <canvas height="250" id="graficaEvaluaciones">
                            </canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a aria-expanded="false" data-toggle="tab" href="#tab_1">
                        Ingeniería en software
                    </a>
                </li>
                <li class="">
                    <a aria-expanded="false" data-toggle="tab" href="#tab_2">
                        Seguridad Ciudadana
                    </a>
                </li>
                <li class="">
                    <a aria-expanded="true" data-toggle="tab" href="#tab_3">
                        Producción Industrial
                    </a>
                </li>
                <li class="">
                    <a aria-expanded="true" data-toggle="tab" href="#tab_4">
                        Ingeniería en Plásticos
                    </a>
                </li>
            </ul>
            {{-- {{ Auth::user()->carrera }} --}}
            <div class="tab-content">
                <div class="tab-pane" id="tab_1">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="fc fc-unthemed fc-ltr" id="calendar1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="fc fc-unthemed fc-ltr" id="calendar2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="fc fc-unthemed fc-ltr" id="calendar3">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="fc fc-unthemed fc-ltr" id="calendar4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div aria-labelledby="myModalLabel" class="modal fade" data-backdrop="static" data-keyboard="false" id="ModalAdd" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header label-info">
                <h4 class="modal-title" id="myModalLabel">
                    <i class="fa fa-calendar-check-o">
                    </i>
                    Nuevo Solicitud
                </h4>
            </div>
            {!! Form::open(['route'=>'solicitud.store', 'method'=>'POST','files' => true,'id'=>'FormE' ]) !!}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('area_id','Tipo de Espacio académico') !!}
                            {!! Form::select('area_id', $areasE, null, ['placeholder' => 'Selecciona un Espacio', 'class'=>'form-control select2','id'=>'area_id','style'=>'width: 100%;','tabindex'=>'-1','required']) !!}
                            @if ($errors->has('area_id'))
                            <span class="label label-danger">
                                <strong>
                                    {{ $errors->first('area_id') }}
                                </strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('espacio_id','Espacio académico') !!}
                            <select aria-hidden="true" class="form-control select2 select2-hidden-accessible" id="espacio_id" name="espacio_id" required="true" style="width: 100%;" tabindex="-1">
                            </select>
                            @if ($errors->has('espacio_id'))
                            <span class="label label-danger">
                                <strong>
                                    {{ $errors->first('espacio_id') }}
                                </strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" id="fecha-Inicio">
                        <div class="form-group">
                            {!! Form::label('fechaInicio', 'Fecha de inicio') !!}
                                {!! Form::date('fechaInicio', null, ['class'=>'form-control text-capitalize', 'placeholder' => 'Fecha de inicio', 'id'=>'fechaInicio','required']) !!}
                                @if ($errors->has('fechaInicio'))
                            <span class="label label-danger">
                                <strong>
                                    {{ $errors->first('fechaInicio') }}
                                </strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6" id="fecha-Fin">
                        <div class="form-group">
                            {!! Form::label('fechaFin', 'Fecha de finalización') !!}
                                {!! Form::date('fechaFin', null, ['class'=>'form-control text-capitalize', 'placeholder' => 'Fecha de finalización', 'id'=>'fechaFin','required']) !!}
                                @if ($errors->has('fechaFin'))
                            <span class="label label-danger">
                                <strong>
                                    {{ $errors->first('fechaFin') }}
                                </strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('horaInicio', 'Hora de inicio') !!}
                                {!! Form::time('horaInicio', null, ['class'=>'form-control text-capitalize', 'placeholder' => 'Hora de inicio','id'=>'horaInicio','required']) !!}
                                @if ($errors->has('horaInicio'))
                            <span class="label label-danger">
                                <strong>
                                    {{ $errors->first('horaInicio') }}
                                </strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('horaFin', 'Hora de finalización') !!}
                                {!! Form::time('horaFin', null, ['class'=>'form-control text-capitalize', 'placeholder' => 'Hora de finalización', 'id'=>'horaFin','required']) !!}
                                @if ($errors->has('horaFin'))
                            <span class="label label-danger">
                                <strong>
                                    {{ $errors->first('horaFin') }}
                                </strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('asistentesEstimados', 'Asistentes Estimados') !!}
                                {!! Form::text('asistentesEstimados', null, ['class'=>'form-control', 'placeholder' => 'Asistentes Estimados','id'=>'asistentesEstimados', 'pattern'=>'^[0-9]+','min'=>'1','required']) !!}
                                @if ($errors->has('asistentesEstimados'))
                            <span class="label label-danger">
                                <strong>
                                    {{ $errors->first('asistentesEstimados') }}
                                </strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('actividadAcademica', 'Actividad Académica') !!}
                            {!! Form::textArea('actividadAcademica', null, ['class'=>'form-control', 'placeholder'=>'Actividad Académica','id'=>'actividadAcademica','size' => '30x4' ,'required']) !!}
                            @if ($errors->has('actividadAcademica'))
                            <span class="label label-danger">
                                <strong>
                                    {{ $errors->first('actividadAcademica') }}
                                </strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <button class="btn btn-primary btn-rounded waves-effect waves-light m-b-5 btn-block" type="submit">
                            <i class="md md-check">
                            </i>
                            Guardar
                        </button>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <button class="btn btn-danger btn-rounded waves-effect waves-light m-b-5 btn-block" id="btnCerrar" type="button">
                            <i class="md md-cancel">
                            </i>
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
{{-- Modal Solicitud --}}
<div aria-labelledby="myModalLabel" class="modal fade" data-backdrop="static" data-keyboard="false" id="myModal" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header label-success">
                <h4 class="modal-title" id="myModalLabel">
                    <i class="fa fa-calendar-check-o">
                    </i>
                    Información de la Solicitud
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <strong>
                                Nombre:
                            </strong>
                            <p class="lead" id="solicitante">
                            </p>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <strong>
                                Espacio:
                            </strong>
                            <p class="lead" id="espacio">
                            </p>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <strong>
                                Actividad Académica:
                            </strong>
                            <p class="lead" id="actividadAcademica">
                            </p>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <strong>
                                Fecha de Inicio:
                            </strong>
                            <p class="lead" id="fechaInicio">
                            </p>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <strong>
                                Fecha de Finalización:
                            </strong>
                            <p class="lead" id="fechaFin">
                            </p>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <strong>
                                Hora de Inicio:
                            </strong>
                            <p class="lead" id="horaInicio">
                            </p>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <strong>
                                Hora de Finalización:
                            </strong>
                            <p class="lead" id="horaFin">
                            </p>
                        </div>
                    </div>
                    <div class="col-xs-6">
                    </div>
                    <div class="col-xs-6">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="btnCerrar2" type="button">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Horario -->
<div aria-labelledby="myModalLabel" class="modal fade" data-backdrop="static" data-keyboard="false" id="infoHorario" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="header">
                <h4 class="modal-title" id="myModalLabel" style="color: #fff">
                    <i class="fa fa-calendar-check-o">
                    </i>
                    Información del horario
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <strong>
                                Materia:
                            </strong>
                            <p class="lead" id="actividadAcademica">
                            </p>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <strong>
                                Docente:
                            </strong>
                            <p class="lead" id="docente">
                            </p>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <strong>
                                Horario:
                            </strong>
                            <p class="lead" id="horario">
                            </p>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <strong>
                                Fecha:
                            </strong>
                            <p class="lead" id="fechaInicio">
                            </p>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <strong>
                                Carrera:
                            </strong>
                            <p class="lead" id="carrera">
                            </p>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <strong>
                                Semestre
                            </strong>
                            <p class="lead" id="semestre">
                            </p>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <strong>
                                Grupo:
                            </strong>
                            <p class="lead" id="grupo">
                            </p>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <strong>
                                Espacio Académico
                            </strong>
                            <p class="lead" id="espacio">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-defacult" data-dismiss="modal" id="btnCerrar3" type="button">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('bower_components/moment/moment.js') }}">
</script>
<script src="{{ asset('bower_components/fullcalendar/dist/fullcalendar.min.js') }}">
</script>
<script src="{{ asset('bower_components/fullcalendar/dist/locale-all.js') }}">
</script>
<script src="{{ asset('bower_components/fullcalendar/dist/locale/es.js') }}">
</script>
<script src="{{ asset('bower_components/raphael/raphael.min.js') }}">
</script>
<script src="{{ asset('bower_components/morris.js/morris.min.js') }}">
</script>
<script>
    $(document).ready(function() {
        $('#fechaFin').change(function(){
            var fechaInicio=$('#fechaInicio').val();
            var fechaFin=$('#fechaFin').val()
            var diaI=fechaInicio.substring(0,2);
            var mesI=fechaInicio.substring(3,5);
            var diaF=fechaFin.substring(0,2);
            var mesF=fechaFin.substring(3,5);
            console.log(diaI +' '+ diaF +' '+ mesI +' '+mesF);
             if (diaF<diaI && mesF<=mesI || diaF>diaI && mesF<=mesI)
            {

                toastr["warning"]('La fecha de finalización '+fechaFin+' no puede ser menor a la de inicio')

                $('#fechaFin').val(fechaInicio);
            }
        });
        var cont=0;
        $('#area_id').select2({
            placeholder: 'Selecciona un Área',
        });
        $('#espacio_id').select2({
          placeholder: 'Selecciona un Espacio Académico'
        });
        $("#area_id" ).change(function()
        {
           var idA=$('#area_id').val();
           console.log('Area : '+idA);
           $('#datosEspacio').html('');
           $('#espacio_id').html('');
           $('#elementosEspacio').html('');
           espaciosAcademicos(idA);
        });

        $("#espacio_id" ).change(function()
        {
           var value=$('#espacio_id').val();
           if (value==0) {
              $('#elementosEspacio').html('');
           }
        });
        @switch(Auth::user()->carrera)
            @case(1)
                $('#tab_1').addClass('active');
                calendario(1,1);
                @break
            @case(2)
                $('#tab_2').addClass('active');
                calendario(2,2);
                @break
            @case(3)
                $('#tab_3').addClass('active');
                calendario(3,3);
                @break
            @case(4)
                $('#tab_4').addClass('active');
                calendario(4,4);
                @break
            @default
                $('#tab_1').addClass('active');
                calendario(1,1);
                calendario(2,2);
                calendario(3,3);
                calendario(4,4);
        @endswitch


        // solicitudesFullCalendarUsuariosPendientes
        $('#btnCerrar').click(function(event) {
            document.getElementById("FormE").reset();
            $('#ModalAdd').modal('hide');
        });

         $('#btnCerrar2').click(function(event) {
            $('#myModal #solicitante').html('');
            $('#myModal #actividadAcademica').html('');
            $('#myModal #espacio').html('');
            $('#myModal #fechaInicio').html('');
            $('#myModal #fechaFin').html('');
            $('#myModal #horaInicio').html('');
            $('#myModal #horaFin').html('');
            $('#myModal').modal('hide');
        });
        $('#btnCerrar3').click(function(event) {
            $('#infoHorario #actividadAcademica').html('');
            $('#infoHorario #docente').html('');
            $('#infoHorario #fechaInicio').html('');
            $('#infoHorario #horario').html('');
            $('#infoHorario #carrera').html('');
            $('#infoHorario #semestre').html('');
            $('#infoHorario #grupo').html('');
            $('#infoHorario #docente').html('');
            $('#infoHorario #espacio').html('');
            $('#infoHorario').modal('hide');
        });
    });

    function calendario($carrera, $cont) {
         //Calendario de eventos
        $('#calendar'+$cont+'').fullCalendar({
            viewRender: function(currentView){
                var minDate = moment(),
                maxDate = moment().add(2,'weeks');
                if (minDate >= currentView.start && minDate <= currentView.end) {
                    $(".fc-prev-button").prop('disabled', true);
                    $(".fc-prev-button").addClass('fc-state-disabled');
                }
                else {
                    $(".fc-prev-button").removeClass('fc-state-disabled');
                    $(".fc-prev-button").prop('disabled', false);
                }
                // futuro
                if (maxDate >= currentView.start && maxDate <= currentView.end) {
                    $(".fc-next-button").prop('disabled', true);
                    $(".fc-next-button").addClass('fc-state-disabled');
                } else {
                    $(".fc-next-button").removeClass('fc-state-disabled');
                    $(".fc-next-button").prop('disabled', false);
                }
            },
            defaultView: 'agendaWeek',
            navLinks: true,
            lang: 'es',
            minTime: "07:00:00",
            maxTime: "18:00",
            contentHeight: auto,
            hiddenDays: [ 0 ],
            header    : {
                left  : 'prev,next today',
                center: 'title',
                right : 'month,agendaWeek,agendaDay,listWeek'
            },
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week : 'Semana',
                day  : 'Dia',
                listWeek :'Lista'
            },
            events : 'admin/solicitudes/solicitudesFullCalendarUsuarios/'+ $carrera,
            weekNumbers: true,
            eventLimit: true,
            timeFormat: 'hh(:mm)t',
            nowIndicator: true,
            selectable: true,
            selectHelper: true,
            select: function(start, end) {
                var fechaActual=moment().format('L');
                var fechaActual2 = moment(fechaActual, "DD-MM-YYYY");
                var fechaSeleccionada=moment(start).format('L');
                var fechaSeleccionada2=moment(fechaSeleccionada, "DD-MM-YYYY");
                var fechaSeleccionadaFin=moment(end).format('L');
                var horaActual=moment().format('HHmm');
                var horaSeleccionada=moment(start).format('HHmm');

                if (fechaSeleccionada==fechaSeleccionadaFin) {
                    if (fechaSeleccionada2<=fechaActual2) {
                        if(horaSeleccionada<=horaActual){
                            toastr["error"]("No se pueden realizar solicitud de espacios con fechas u hora pasadas.");
                        }else{
                            $('#ModalAdd #fechaInicio').val(moment(start).format('YYYY-MM-DD'));
                            var fecha = new Date(end);
                            var fin = fecha.setDate(fecha.getDate());
                            $('#ModalAdd #fechaFin').val(moment(fin).format('YYYY-MM-DD'));
                            $('#ModalAdd #horaInicio').val(moment(start).format('HH:mm'));
                            $('#ModalAdd #horaFin').val(moment(end).format('HH:mm'));
                            $('#ModalAdd').modal('show');
                        }
                    }else{
                        $('#ModalAdd #fechaInicio').val(moment(start).format('YYYY-MM-DD'));
                        var fecha = new Date(end);
                        var fin = fecha.setDate(fecha.getDate());
                        $('#ModalAdd #fechaFin').val(moment(fin).format('YYYY-MM-DD'));
                        $('#ModalAdd #horaInicio').val(moment(start).format('HH:mm'));
                        $('#ModalAdd #horaFin').val(moment(end).format('HH:mm'));
                        $('#ModalAdd').modal('show');
                    }
                }else{
                    toastr["error"]("Rango de fechas no valido.");
                }

            },
            eventClick: function(calEvent, jsEvent) {
                if (calEvent.url) {
                    return true;
                }else{
                    $.ajax({
                        url: '/admin/solicitudes/mostrarSolicitud/'+calEvent.id+'',
                        type: 'GET',
                        dataType: 'JSON',
                        success:function(data) {
                            if (data.tipoRegistro==0) {
                                 if (data.tipoUsuario==0||data.tipoUsuario==1) {
                                    $('#myModal #solicitante').append(data.solicitante_admin.nombre +'  '+ data.solicitante_admin.apellidoP +' '+ data.solicitante_admin.apellidoM)
                                }else
                                {
                                    $('#myModal #solicitante').append(data.solicitante.nombre+' '+data.solicitante.apellidoP+' '+data.solicitante.apellidoM)
                                }

                                $('#myModal #espacio').append(data.espacio.nombre);
                                $('#myModal #fechaInicio').append(moment(data.fechaInicio).format('dddd D [de] MMMM YYYY'));
                                $('#myModal #fechaFin').append(moment(data.fechaFin).format('dddd D [de] MMMM YYYY'));
                                $('#myModal #horaInicio').append(data.horaInicio);
                                $('#myModal #horaFin').append(data.horaFin);
                                $('#myModal #actividadAcademica').append(data.actividadAcademica);
                                $('#myModal').modal('show');
                            }else{
                                document.getElementById('header').style.background=data.background;
                                document.getElementById('btnCerrar3').style.background=data.background;
                                document.getElementById('btnCerrar3').style.color='#fff';
                                 $('#infoHorario #actividadAcademica').append(data.actividadAcademica);
                                 $('#infoHorario #docente').append(data.docente);
                                 $('#infoHorario #fechaInicio').append(moment(data.fechaInicio).format('dddd D [de] MMMM YYYY'));
                                 $('#infoHorario #horario').append(data.horaInicio+' - '+ data.horaFin);
                                switch(data.carrera) {
                                    case 1:
                                        $('#infoHorario #carrera').append('Ing. En Software');
                                        break;
                                    case 2:
                                        $('#infoHorario #carrera').append('Lic. Seguridad Ciudadana');
                                        break;
                                    case 3:
                                        $('#infoHorario #carrera').append('Ing. En Producción Industrial');
                                        break;
                                    case 4:
                                        $('#infoHorario #carrera').append('Ing. En Plasticos');
                                        break;
                                }
                                $('#infoHorario #semestre').append(data.semestre);
                                $('#infoHorario #grupo').append(data.grupo);
                                $('#infoHorario #espacio').append(data.espacio.nombre);
                                $('#infoHorario').modal('show');
                            }
                        }
                    });
                }
            },
        });

    }
    function espaciosAcademicos(idA)
    {
        $.ajax({
            url: '/admin/solicitudes/espacios/'+idA,
            type: 'GET',
            dataType: 'JSON',
            success:function(data){
                console.log(data);
                $.each(data, function(i, item) {
                  if (item.disponible==0) {
                    $('#espacio_id').append('<option value='+item.id+'>'+item.nombre+'</option>');
                  }else {
                    $('#espacio_id').append('<option disabled value='+item.id+'>'+item.nombre+' - no disponible</option>');
                  }
                     // $('#espacio_id').append('<option value='+item.id+'>'+item.nombre+'</option>');
                });
            }
        })
    }

     toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": true,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
</script>
<script>
    var puntuacion = [];
    var colores=[];
    var total;
    var cal1 = [];
    var cal2 = [];
    var cal3 = [];
    var cal4 = [];
    var cal5 = [];
    $.get('/grafica/evaluaciones-usuario', function(data) {
        puntuacion = [];
        cal1=[];
        cal2=[];
        cal3=[];
        cal4=[];
        cal5=[];
        $.each(data, function(i, item) {
            cal1.push(item.cal1);
            cal2.push(item.cal2);
            cal3.push(item.cal3);
            cal4.push(item.cal4);
            cal5.push(item.cal5);
        });
        var ctx = document.getElementById("graficaEvaluaciones").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                datasets: [
                {
                  label: "Puntuación",
                  backgroundColor: "#3e95cd",
                  data: cal1
                },
                {
                  label: "Limpieza",
                  backgroundColor: "#8e5ea2",
                  data: cal2
                },
                {
                  label: "Atención",
                  backgroundColor: "#3cba9f",
                  data: cal3
                },
                {
                  label: "Cumplió con la actividad a realizar",
                  backgroundColor: "#e8c3b9",
                  data: cal4
                },
                {
                  label: "Condición de los elementos solicitados",
                  backgroundColor: "#c45850",
                  data: cal5
                }
              ]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Calificación perfecta: 4'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    });
</script>
@endsection

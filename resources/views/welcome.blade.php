@extends('layouts.app')

@section('content')
<div class="text-center">
    <h2>
        Administración de espacios académicos.
    </h2>
</div>
@section('calendar')
<div class="container-fluid">
    <div class="row">
        {{--
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body no-padding">
                    <div class="fc fc-unthemed fc-ltr" id="calendar">
                    </div>
                </div>
            </div>
        </div>
        --}}
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active" id="litab_1">
                        <a aria-expanded="false" data-toggle="tab" href="#tab_1">
                            Ingeniería en software
                        </a>
                    </li>
                    <li class="" id="litab_2">
                        <a aria-expanded="false" data-toggle="tab" href="#tab_2">
                            Seguridad Ciudadana
                        </a>
                    </li>
                    <li class="" id="litab_3">
                        <a aria-expanded="true" data-toggle="tab" href="#tab_3">
                            Producción Industrial
                        </a>
                    </li>
                    <li class="" id="litab_4">
                        <a aria-expanded="true" data-toggle="tab" href="#tab_4">
                            Ingeniería en Plásticos
                        </a>
                    </li>
                    <li class="pull-right">
                        <a class="btn btn-primary" href="{{ route('calendarios.create') }}">
                            <i class="fa fa-calendar-plus-o">
                            </i>
                            Nuevo
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
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
<script type="text/javascript">
    $(document).ready(function() {
        calendario(1,1);
        calendario(2,2);
        calendario(3,3);
        calendario(4,4);
    });


    function calendario($cont,$carrera){
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
                // if (maxDate >= currentView.start && maxDate <= currentView.end) {
                //     $(".fc-next-button").prop('disabled', true);
                //     $(".fc-next-button").addClass('fc-state-disabled');
                // } else {
                //     $(".fc-next-button").removeClass('fc-state-disabled');
                //     $(".fc-next-button").prop('disabled', false);
                // }
            },

            defaultView: 'agendaWeek',
            navLinks: true,
            lang: 'es',
            minTime: "07:00:00",
            maxTime: "18:00:00",
            hiddenDays: [ 0 ],
            businessHours: {
                start: '07:00', // hora final
                end: '18:00', // hora inicial
                dow: [ 1, 2, 3, 4, 5, 6 ] // dias de semana, 0=Domingo
            },
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
            events : 'calendar/'+$carrera,
            weekNumbers: true,
            eventLimit: true, // allow "more" link when too many events
            timeFormat: 'hh(:mm)t',
            nowIndicator: true,
            selectable: true,
            selectHelper: true,
            select: function(start, end) {
                toastr["info"]("Inicia sesion para realizar la solicitud <br/><br/><a href='{{ route('login') }}' type='button' class='btn bg-navy btn-flat'>Iniciar Sesión</button>");
            },
             eventClick: function(calEvent, jsEvent) {
                $.get('/mostrar_evento/'+calEvent.id, function(data) {
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
                });
            },
        });
    }
    //Calendario de eventos
        
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
</script>
@endsection

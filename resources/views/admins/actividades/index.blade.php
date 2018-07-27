{{ Toastr::clear() }}
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
        <li class="active">
            Calendario Escolar
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a aria-expanded="false" data-toggle="tab" href="#tab_1">
                        Ingenieria en software
                    </a>
                </li>
                <li class="">
                    <a aria-expanded="false" data-toggle="tab" href="#tab_2">
                        Seguridad Ciudadana
                    </a>
                </li>
                <li class="">
                    <a aria-expanded="true" data-toggle="tab" href="#tab_3">
                        Produccion Industrial
                    </a>
                </li>
                <li class="">
                    <a aria-expanded="true" data-toggle="tab" href="#tab_4">
                        Ingenieria en Plasticos
                    </a>
                </li>
                <li class="pull-right">
                    <a class="btn btn-primary" href="{{ route('actividades.create') }}">
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
<div aria-labelledby="myModalLabel" class="modal fade" id="ModalAdd" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header label-info">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    <i class="fa fa-calendar-check-o">
                    </i>
                    Informacion
                </h4>
            </div>
            <div class="box-body" id="infoActividad">
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button aria-label="Close" class="btn btn-danger btn-block waves-effect waves-light m-b-5 btn-block" data-dismiss="modal" id="btnCerrar" type="button">
                            <i class="md md-cancel">
                            </i>
                            Cerrar
                        </button>
                    </div>
                </div>
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
        calendarioEventos(1,1);
        calendarioEventos(2,2);
        calendarioEventos(3,3);
        calendarioEventos(4,4);
    });

    function calendarioEventos(calendario,carrera) {
        $('#calendar'+calendario+'').fullCalendar({
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
            events : '/admin/actividades/actividadesFullCalendar/'+carrera+'',
            weekNumbers: true,
            eventLimit: true, 
            timeFormat: 'hh(:mm)t',
            // editable: true,
            nowIndicator: true,
            eventClick: function(calEvent, jsEvent, view) {
                $('#infoActividad').html('');
                $('#infoActividad').append('<p class="lead text-center">'+calEvent.title+'</p>');
                // alert('Event: ' + calEvent.title);
                // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
                // alert('View: ' + view.name);
                $('#ModalAdd').modal('show');
                // change the border color just for fun
                // $(this).css('border-color', 'red');

              }
        }); 
    }
</script>
@endsection

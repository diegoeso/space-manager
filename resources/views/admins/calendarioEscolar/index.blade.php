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
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active" id="litab_1">
                    <a aria-expanded="false" data-toggle="tab" href="#tab_1">
                        Ingenieria en software
                    </a>
                </li>
                <li class="" id="litab_2">
                    <a aria-expanded="false" data-toggle="tab" href="#tab_2">
                        Seguridad Ciudadana
                    </a>
                </li>
                <li class="" id="litab_3">
                    <a aria-expanded="true" data-toggle="tab" href="#tab_3">
                        Produccion Industrial
                    </a>
                </li>
                <li class="" id="litab_4">
                    <a aria-expanded="true" data-toggle="tab" href="#tab_4">
                        Ingenieria en Plasticos
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
            {{-- {{ Auth::user()->carrera }} --}}
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
        calendario(1,1);
        calendario(2,2);
        calendario(3,3);
        calendario(4,4);
    });

     function calendario($cont, $carrera) {
         //Calendario de eventos
        $('#calendar'+$cont+'').fullCalendar({
            defaultView: 'agendaWeek',
            // link a los dias del mes (info)
            navLinks: true,
            // idioma
            lang: 'es',
            // hora de inicio
            minTime: "07:00:00",
            // hora de fin
            maxTime: "18:00",
            // ocultar dias
            hiddenDays: [ 0 ],
          
            // botones de la parte superior
            header    : {
                left  : 'prev,next today',
                center: 'title',
                right : 'month,agendaWeek,agendaDay,listWeek'
            },
            // texto de los botones
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week : 'Semana',
                day  : 'Dia',
                listWeek :'Lista'
            },
            // listado de eventos desde un array del controlador
            events : '/admin/calendario/calendarioEscolar/'+ $carrera,
            // numero de semana
            weekNumbers: true,
            // limete de eventos (+3)
            eventLimit: true, // allow "more" link when too many events
            // formato de la hora
            timeFormat: 'hh(:mm)t',
            // editable: true,
            // indicador de la hora actual
            nowIndicator: true,
            // seleccionar dia u hora
            selectable: true,
            selectHelper: true,      
        });

    }
</script>
@endsection

@extends('layouts.app')

@section('content')
<div class="title m-b-md text-center">
    Space Manager
</div>
@section('calendar')
<div class="container-fluid">
    <div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body no-padding">
                <div class="fc fc-unthemed fc-ltr" id="calendar">
                </div>
            </div>
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
    //Calendario de eventos
        $('#calendar').fullCalendar({
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
            events : 'admin/solicitudes/solicitudesFullCalendar/2',
            weekNumbers: true,
            eventLimit: true, // allow "more" link when too many events
            timeFormat: 'hh(:mm)t',
            nowIndicator: true,
            selectable: true,
            selectHelper: true,
            select: function(start, end) {
                var fechaActual=moment().format('L');
                var fechaActual2 = moment(fechaActual, "DD-MM-YYYY");
                
                var fechaActual3 = moment(fechaActual, "DD-MM-YYYY HHmm");

                var fechaSeleccionada=moment(start).format('L');
                var fechaSeleccionada2=moment(fechaSeleccionada, "DD-MM-YYYY");
                var fechaSeleccionadaFin=moment(end).format('L');
                var horaActual=moment().format('HHmm');
                var horaSeleccionada=moment(start).format('HHmm');
                var horaSeleccionadaFin=moment(end).format('HHmm');
                
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
        });
</script>
@endsection

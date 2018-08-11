@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>
                    {{ count($solicitudes) }}
                </h3>
                <p>
                    Solicitudes
                </p>
            </div>
            <div class="icon">
                <i class="fa fa-calendar-check-o">
                </i>
            </div>
            <a class="small-box-footer" href="{{ route('solicitudes.index') }}">
                Más información
                <i class="fa fa-arrow-circle-right">
                </i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
            <div class="inner">
                <h3>
                    {{ count($areas) }}
                </h3>
                <p>
                    Áreas
                </p>
            </div>
            <div class="icon">
                <i class="fa fa-university">
                </i>
            </div>
            <a class="small-box-footer" href="{{ route('areas.index') }}">
                Más información
                <i class="fa fa-arrow-circle-right">
                </i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>
                    {{ count($espacios) }}
                </h3>
                <p>
                    Espacios Académicos
                </p>
            </div>
            <div class="icon">
                <i class="fa fa-building">
                </i>
            </div>
            <a class="small-box-footer" href="{{ route('espacios.index') }}">
                Más información
                <i class="fa fa-arrow-circle-right">
                </i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>
                    {{ count($usuarios) }}
                </h3>
                <p>
                    Usuarios Registrados
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add">
                </i>
            </div>
            <a class="small-box-footer" href="{{ route('usuarios.index') }}">
                Más Información
                <i class="fa fa-arrow-circle-right">
                </i>
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Uso de espacios académicos
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
                    <div class="col-md-6">
                        <div class="chart">
                            <canvas height="300" id="grafica1">
                            </canvas>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="direct-chat direct-chat-warning">
                            <div class="box-body">
                                <div class="direct-chat-messages" id="info">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
<!-- Modal -->
<div aria-labelledby="myModalLabel" class="modal fade" data-backdrop="static" data-keyboard="false" id="ModalAdd" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header label-info">
                <h4 class="modal-title text-center" id="myModalLabel">
                    <i class="fa fa-calendar-check-o">
                    </i>
                    Nuevo Solicitud
                </h4>
            </div>
            {!! Form::open(['route'=>'solicitudes.store', 'method'=>'POST','files' => true,'id'=>'FormE' ]) !!}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('area_id','Tipo de Espacio Académico') !!}
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
                            {!! Form::label('espacio_id','Espacio Académico') !!}
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
                            {!! Form::label('fechaInicio', 'Fecha de Inicio') !!}
                                {!! Form::date('fechaInicio', null, ['class'=>'form-control text-capitalize', 'placeholder' => 'Fecha de Inicio', 'id'=>'fechaInicio','required','readonly']) !!}
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
                            {!! Form::label('fechaFin', 'Fecha de Finalización') !!}
                                {!! Form::date('fechaFin', null, ['class'=>'form-control text-capitalize', 'placeholder' => 'Fecha de Finalización', 'id'=>'fechaFin','required','readonly']) !!}
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
                                {!! Form::time('horaInicio', null, ['class'=>'form-control text-capitalize', 'placeholder' => 'Hora de inicio','id'=>'horaInicio','required','readonly']) !!}
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
                            {!! Form::label('horaFin', 'Hora de Finalización') !!}
                                {!! Form::time('horaFin', null, ['class'=>'form-control text-capitalize', 'placeholder' => 'Hora de Finalización', 'id'=>'horaFin','required','readonly']) !!}
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
                    <div class="col-md-6">
                        <button class="btn btn-primary btn-rounded waves-effect waves-light m-b-5 btn-block" type="submit">
                            <i class="fa fa-plus">
                            </i>
                            Guardar
                        </button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-danger btn-rounded waves-effect waves-light m-b-5 btn-block" id="btnCerrar" type="button">
                            <i class="fa fa-remove">
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
@endsection
@section('script')
<script src="https://www.gstatic.com/charts/loader.js" type="text/javascript">
</script>
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
         // validacion que la fecha de termino no sea menor a la de inicio
        $('#horaFin').change(function(){
            $horaInicio=$('#horaInicio').val();
            $horaFin=$('#horaFin').val();
            if ($horaFin<$horaInicio) {
               toastr["warning"]('La hora de finalización no puede ser menor a la de inicio');
               $('#horaFin').val($horaInicio);
            }
        });
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
           console.log('Área : '+idA);
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

        $('#add').click(function(event) {
            cont++;
            categorias(cont);
            $('#dynamic_field').append('<tr id="row'+cont+'"><td><select class="form-control" id="categoria_id'+cont+'" name="categoria_id[]" placeholder="Selecciona una Categoría" style="width: 100%;" tabindex="-1"></select></td><td><select class="form-control" id="elemento_id'+cont+'" name="elemento_id[]" placeholder="Selecciona un Elemento" style="width: 100%;" tabindex="-1"></select></td><td><input class="form-control" id="cantidad'+cont+'" min="1" name="cantidad[]" pattern="^[0-9]+" type="text"  placeholder="Cantidad" style="width: 100%;"/></td><td><button type="button" name="remove" id="'+cont+'" class="btn btn-danger btn_remove btn-sm"><span class="fa fa-trash"></span></button></td></tr>');

            $('#categoria_id'+cont+'').append('<option>Selecciona una Categoría</option>');
            $('#elemento_id'+cont+'').append('<option>Selecciona un Elemento</option>');
            $('#categoria_id'+cont+'').select2({
            placeholder: 'Selecciona una Categoría',
            });
            $('#elemento_id'+cont+'').select2({
              placeholder: 'Selecciona un Elemento'
            });
            $('#categoria_id'+cont+'').change(function(event) {
                event.preventDefault();
                var idCategoria=$('#categoria_id'+cont+'').val();
                var idElemento=$('#elemento_id'+cont+'').val();
                console.log('Categoría '+idCategoria);
                var id = $(this).attr("id");
                var res = id.substring(12);
                console.log(res);
                $('#elemento_id'+res+'').html('');
                elementos(idCategoria,res);
            });

            $('#cantidad'+cont+'').keyup(function(e) {
                if(isNaN(this.value + String.fromCharCode(e.charCode)))
                 return false;
                $key=$('#cantidad'+cont+'').val();
                console.log($key);
            })
            .on("cut copy paste",function(e){
                e.preventDefault();
            });

            var myInput = document.getElementById('cantidad'+cont+'');
                myInput.onpaste = function(e) {
                e.preventDefault();
                toastr["error"]("¡No se puede realizar esta acción!")
                
            }

        });
        // Elimna los elementos agregados (cajas de texto)
        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });

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
            // selectOverlap: function(event) {
            //      return event.rendering === 'background';
            // },
            weekNumbers: true,
            eventLimit: true, // allow "more" link when too many events
            timeFormat: 'hh(:mm)t',
            nowIndicator: true,
            selectable: true,
            selectHelper: true,
            select: function(start, end) {
                var fechaActual=moment().format('L');
                var fechaSeleccionada=moment(start).format('L');
                var fechaSeleccionadaFin=moment(end).format('L');
                var horaActual=moment().format('HHmm');
                var horaSeleccionada=moment(start).format('HHmm');
                if (fechaSeleccionada==fechaSeleccionadaFin) {
                    if (fechaSeleccionada<=fechaActual && horaActual>horaSeleccionada || fechaSeleccionada<fechaActual ) {
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
                    toastr["error"]("Rango de fechas no valido.");   
                }
                
            },
        }); 

        // Cerrar ventana modal y resetear el formulario para borrar los datos que tienen los input
        $('#btnCerrar').click(function(event) {
            document.getElementById("FormE").reset();
            $("#fechaInicio").attr('disabled','disabled');
            $("#fechaFin").attr('disabled','disabled');
            $('#ModalAdd').modal('hide');
        });

    });
    

    function espaciosAcademicos(idA)
    {
        $.ajax({
            url: '/admin/solicitudes/espacios/'+idA,
            type: 'GET',
            dataType: 'JSON',
            success:function(data){
                console.log(data);
                $.each(data, function(i, item) {
                     $('#espacio_id').append('<option value='+item.id+'>'+item.nombre+'</option>');
                });
            }
        })
    }

    function infoEspacio(value)
    {
        $('#datosEspacio').html('');
        var url='/admin/solicitudes/infoEspacio/'+value+'';
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $('#datosEspacio').append('<p class="lead">'+data.nombre+'</p><p>'+data.ubicacion+'</p><p>'+data.descripcion+'</p><p></p>');
                elementosEspacio(value);
            },

        })
    }

    function elementosEspacio(value)
    {
        $('#elementosEspacio').html('');
        $.get('/admin/solicitudes/elementos-espacio/'+value, function(data) {
            if (data.length > 0 && value!=0) {
                $('#elementosEspacio').append('<p class="lead">Elementos con los que cuenta el <em>Espacio</em></p>');
                $.each(data, function(i, item) {
                    $('#elementosEspacio').append('<div class="col-md-6 col-sm-12 col-xs-6"><p><strong>Elemento: </strong>'+item.nombre+'</p>'+
                        '<p><strong>Cantidad: </strong>'+item.cantidad+'</p></div>');
                });
            }else{
                $('#elementosEspacio').append('<p class="lead text-center">Sin elementos asociados</p>');
            }

        });
    }

    // elementos adicionales
    function categorias(cont)
    {
        // $('#categoria_id'+cont+'').html('');
        $('#categoria_id'+cont+'').append('<option>Selecciona una Categoria</option>');
        $.ajax({
            url: '/admin/espacios/categorias-elementos/1',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                console.log(data);
                $.each(data, function(i, item) {
                    $('#categoria_id'+cont+'').append('<option value='+item.id+'>'+item.nombre+'</option>');
                });
            },
        });
    }

    function elementos(idCategoria,res)
    {
        console.log(res);
        $('#elemento_id'+res+'').html('');
        $('#elemento_id'+res+'').append('<option>Selecciona un Elemento</option>');
        $.ajax({
            url: '/admin/espacios/elementos/'+idCategoria+'',
            type: 'GET',
            dataType: 'JSON',
            success:function(data) {
                console.log(data);
                $.each(data, function(i, item) {
                    $('#elemento_id'+res+'').append('<option value='+item.id+'>'+item.nombre+'</option>');
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
      "preventDuplicates": false,
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
    var espacio = [];
    var total = [];
    var colores=[];
    $.get('/grafica/solicitudes', function(data) {
        espacio = [];
        total = [];
        colores=[];
        $.each(data, function(i, item) {
            espacio.push(item.nombre);
            total.push(item.total);
            var r = Math.round(Math.random()*255);
            var g = Math.round(Math.random()*255);
            var b = Math.round(Math.random()*255);
            var rgb="rgba("+r+", "+g+", "+b+", "+1+")";
            colores.push(rgb);
            $('#info').append('<div class="progress-group"><span class="progress-text">'+item.nombre+'</span><span class="progress-number" id="espacio"># '+item.total+'</span><div class="progress sm"><div class="progress-bar" style="width: '+item.total * 100+'px; background-color: '+rgb+'"></div></div></div>');            
        });
        new Chart(document.getElementById("grafica1"), {
            type: 'pie',
            data: {
              labels: espacio,
              datasets: [
                {
                  label: "",
                  backgroundColor: colores,
                  data: total
                }
              ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Espacio académico mas solicitado.'
                }
            }
        });     

        

     });
</script>
@endsection

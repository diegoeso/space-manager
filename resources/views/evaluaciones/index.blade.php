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
            @if (Auth::user()->tipoCuenta==0 || Auth::user()->tipoCuenta==1)
            <a href="{{ url('/admin') }}">
                <i class="fa fa-dashboard">
                </i>
                Home
            </a>
            @else
            <a href="{{ url('/inicio') }}">
                <i class="fa fa-dashboard">
                </i>
                Home
            </a>
            @endif
        </li>
        <li class="active">
            Evaluaciones
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Puntuación General
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
            <div class="box-body" style="">
                <div class="col-md-12">
                    <p class="text-center">
                        <strong>
                            Calificación
                        </strong>
                    </p>
                    <div class="progress-group">
                        <span class="progress-text">
                            Evaluaciones
                        </span>
                        <span class="progress-number">
                            <b>
                                {{ $total/4 * 100 }}
                            </b>
                            /100
                        </span>
                        @php
                                $barra=$total/4 * 100;
                            @endphp
                        <div class="progress sm">
                            <div class="progress-bar progress-bar-aqua" style="width: {{ $barra }}%">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chart">
                    <div height="250" id="piechart" style="height: 250px; width: 580px;" width="580">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Evaluaciones
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
                        <div class="table-responsive">
                            <table class="table table-hover" id="evaluaciones-table">
                                <thead>
                                    <tr>
                                        <th width="10">
                                            ID
                                        </th>
                                        <th>
                                            Espacio
                                        </th>
                                        <th>
                                            Evaluado
                                        </th>
                                        <th>
                                            Fecha
                                        </th>
                                        <th>
                                            Estado
                                        </th>
                                        <th>
                                            Creación
                                        </th>
                                        <th width="10">
                                            Opciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div aria-labelledby="myModalLabel" class="modal fade" data-backdrop="static" data-keyboard="false" id="myModal" role="dialog" tabindex="-1">
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
                <input id="idE" name="idE" type="hidden"/>
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
        $('#evaluaciones-table').DataTable({
            language:{
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
            processing: true,
            serverSide: true,
            info: true,
            autoWidth: false,
            select: true,
            // order: [[0, 'desc']],
            ajax: "evaluaciones/listarEvaluaciones/1",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'solicitud_id', name: 'solicitud_id'},
                {data: 'evaluado', name:'evaluado'},
                {data: 'fecha', name: 'fecha'},
                {data: 'estado', render:function($estado){
                    switch ($estado) {
                    case '1':
                        return '<span class="label label-success">Evaluada</span>';
                        break;
                    default:
                    return '<span class="label label-danger">Sin Evaluar</span>';
                    break;
                }
                }},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: true, searchable: true}
            ],
            order: [[0, 'desc']]
        });

        $(document).on('click', '#evaluar', function(event) {
            let id = this.value;
            console.log("Se presionó el Boton con Id :"+ id);
            $('#idE').val(id);
            $('#myModal').modal('show');
        });

        $('#btnCerrar').click(function(event){
            document.getElementById("formEvaluacion").reset();
            $('#myModal').modal('hide'); 
        });
    });
</script>
<script>
    var pieChartCanvas = $('#chart-area').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
      {
        value    : {{ ($puntuacion->cal1/$cont)/4*100}},
        color    : '#FF9130',
        highlight: '#FF9130',
        label    : 'Puntualidad'
      },
      {
        value    : {{ ($puntuacion->cal2/$cont)/4*100}},
        color    : '#00a65a',
        highlight: '#00a65a',
        label    : 'Limpieza'
      },
      {
        value    : {{ ($puntuacion->cal3/$cont)/4*100}},
        color    : '#f39c12',
        highlight: '#f39c12',
        label    : 'Atención'
      },
      {
        value    : {{ ($puntuacion->cal4/$cont)/4*100}},
        color    : '#00c0ef',
        highlight: '#00c0ef',
        label    : 'Cumplio con la actividad a realizar'
      },
      {
        value    : {{ ($puntuacion->cal5/$cont)/4*100}},
        color    : '#3c8dbc',
        highlight: '#3c8dbc',
        label    : 'Condicion de los elementos solicitados'
      },
    ]
    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 8,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 30, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    pieChart.Doughnut(PieData, pieOptions)
</script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Punto a evaluar', 'Puntuacion'],
              ['Puntualidad', {{ ($puntuacion->cal1/$cont)/4*100}}],
              ['Limpieza', {{ ($puntuacion->cal2/$cont)/4*100}}],
              ['Atención', {{ ($puntuacion->cal3/$cont)/4*100}}],
              ['Cumplio con la actividad a realizar', {{ ($puntuacion->cal4/$cont)/4*100}}],
              ['Condicion de los elementos solicitados (en caso de haber solicitado)', {{ ($puntuacion->cal5/$cont)/4*100}}],
        ]);

        var options = {
          title: 'Puntuación del usuario tomando de referencia el '+{{ $total/4 * 100 }} + ''+' como el 100% para la grafica'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
</script>
@endsection

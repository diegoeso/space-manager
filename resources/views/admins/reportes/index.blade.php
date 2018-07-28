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
        <li class="active">
            Reportes
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Espacio más solicitado
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
                        <div id="grafica" style="height: 100%; width: 100%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Espacio", "Cantidad de solicitudes", { role: "style" }],
        @foreach ($graficas as $grafica)
          @php
            $ran=rand(1,10);
        @endphp
        @switch($ran)
            @case(1)
                @php
                    $color='#0A6187';
                @endphp
                @break
            @case(2)
                @php
                    $color='#F25944';
                @endphp
                @break
            @case(3)
                @php
                    $color='#F2385A';
                @endphp
                @break
            @case(4)
                @php
                    $color='#F5A503';
                @endphp
                @break
            @case(5)
                @php
                    $color='#4AD9D9';
                @endphp
                @break
            @case(6)
                @php
                    $color='#36B1BF';
                @endphp
                @break
            @case(7)
                @php
                    $color='#0376BC';
                @endphp
                @break
            @case(8)
                @php
                    $color='#F16623';
                @endphp
                @break
            @case(9)
                
                @php
                    $color='#F8BE15';
                @endphp
                @break
            @case(10)
                @php
                    $color= '#4ABF3D';
                @endphp
                @break
        @endswitch
            ['{{ $grafica->espacio->nombre}}', {{ $grafica->total}}, '{{ $color }}'],
        @endforeach
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Espacio Academico mas solicitado",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("grafica"));
      chart.draw(view, options);
  }
</script>
@endsection

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
                Inicio
            </a>
        </li>
        <li>
            <a href="{{ route('solicitud.index') }}">
                Solicitudes
            </a>
        </li>
        <li class="active">
            Nuevo
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
                    Registrar solicitud
                </h3>
                <div class="box-tools">
                    <a class="btn btn-link" href="{{ route('solicitud.index')}}">
                        <span class="fa fa-mail-reply">
                        </span>
                        Volver
                    </a>
                </div>
            </div>
            {!! Form::open(['route'=>'solicitud.store', 'method'=>'POST','files' => true ]) !!}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-7" id="formulario">
                        @include('usuarios.solicitudes.fragmentos.form')
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-12" id="datosEspacio">
                            </div>
                            <div class="col-md-12" id="elementosEspacio">
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success" id="add" name="add" type="button">
                    <i class="md md-add">
                    </i>
                    Agregar Elemento
                </button>
                <div class="table-responsive" id="elementosAdicionales" name="elementosAdicionales">
                    <br/>
                    <table class="table table-striped" id="dynamic_field">
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer">
                <button class="btn btn-primary btn-rounded waves-effect waves-light m-b-5" type="submit" name="guardar" id="guardar">
                    <i class="md md-check">
                    </i>
                    Guardar
                </button>
                <a class="btn btn-danger btn-rounded waves-effect waves-light m-b-5" href="{{ route('solicitud.index') }}">
                    <i class="md md-cancel">
                    </i>
                    Cancelar
                </a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/solicitudCreate.js') }}">
</script>
{{--
<script>
    $(document).ready(function() {
        //Timepicker
        $('#horaInicio').timepicker({
            showMeridian:false,
            showSeconds:true,
        });
        $('#horaFin').timepicker({
            showMeridian:false,
            showSeconds:true,
        });

        // validacion que la fecha de termino no sea menor a la de inicio
        $('#horaFin').change(function(){
            $horaInicio=$('#horaInicio').val();
            $horaFin=$('#horaFin').val();
            if ($horaFin<$horaInicio) {
               toastr["warning"]('La hora de finalizacion no puede ser menor a la de inicio');
               $('#horaFin').val($horaInicio);
            }
        });
        // Datepicker
        $('#fechaInicio').datepicker({
            format: 'dd-mm-yyyy',
            autoHide:true,
            autoPick:true,
            inline:true,
            language:'es-mx'
        });
        $('#fechaFin').datepicker({
            format: 'dd-mm-yyyy',
            autoHide:true,
            autoPick:true,
            inline:true,
            language:'es-mx'
        });
   
         // valida que la fecha de termino del evento no sea menor a la de inicio 
        $('#fechaFin').change(function(){
            var fechaInicio=$('#fechaInicio').val();
            var fechaFin=$('#fechaFin').val()
            var diaI=fechaInicio.substring(0,2);
            var mesI=fechaInicio.substring(3,5);
            var diaF=fechaFin.substring(0,2);
            var mesF=fechaFin.substring(3,5);
            console.log(diaI +' '+ diaF +' '+ mesI +' '+mesF);
            
            if (diaF<diaI && mesF<=mesI || diaF>diaI && mesF<mesI)
            {
                toastr["warning"]('La fecha de finalizacion '+fechaFin+' no puede ser menor a la de inicio');
                $('#fechaFin').val(fechaInicio);
            }
        });
        var cont=0;
        // Inicializacion de plugin select2
        $('#area_id').select2({
            placeholder: 'Selecciona un Area',
        });
        $('#espacio_id').select2({
          placeholder: 'Selecciona un Espacio Academico',
        });
        
        // Validacion
        $("#area_id" ).change(function(){
           var idA=$('#area_id').val();
           console.log('Area : '+idA);
           $('#datosEspacio').html('');
           $('#espacio_id').html('');
           $('#elementosEspacio').html('');
           espaciosAcademicos(idA);
           $('#espacio_id').append('<option>Selecciona un Espacio Academico</option>');
        });

        // Validacion
        $("#espacio_id" ).change(function(){
           var value=$('#espacio_id').val();
           if (value==0) {
              $('#elementosEspacio').html('');
           }
           // console.log(value);
           infoEspacio(value);
        });

       
        $('#add').click(function(event) {
            cont++;
            categorias(cont);
            // Agregacion de formulario para elementos (nueva seccion de input's)
            $('#dynamic_field').append('<tr id="row'+cont+'"><td><select class="form-control" id="categoria_id'+cont+'" name="categoria_id[]" placeholder="Selecciona una Categoria" style="width: 100%;" tabindex="-1"></select></td><td><select class="form-control" id="elemento_id'+cont+'" name="elemento_id[]" placeholder="Selecciona un Elemento" style="width: 100%;" tabindex="-1"></select></td><td><input class="form-control" id="cantidad'+cont+'" min="1" name="cantidad[]" pattern="^[0-9]+" type="text"  placeholder="Cantidad" style="width: 100%;"/></td><td><input class="form-control" id="existencias'+cont+'" min="1" name="existencias'+cont+'" /></td><td><button type="button" name="remove" id="'+cont+'" class="btn btn-danger btn_remove btn-sm"><span class="fa fa-trash"></span></button></td></tr>');

            // Texto a los combobox
            $('#categoria_id'+cont+'').append('<option>Selecciona una Categoria</option>');
            $('#elemento_id'+cont+'').append('<option>Selecciona un Elemento</option>');
            
            //inicializando plugins select2 
            $('#categoria_id'+cont+'').select2({
            placeholder: 'Selecciona una Categoria',
            });
            $('#elemento_id'+cont+'').select2({
              placeholder: 'Selecciona un Elemento'
            });
            // Fin select2
            

            // 
            $('#categoria_id'+cont+'').change(function(event) {
                event.preventDefault();
                var idCategoria=$('#categoria_id'+cont+'').val();
                var idElemento=$('#elemento_id'+cont+'').val();
                console.log('Categoria '+idCategoria);
                var id = $(this).attr("id");
                var res = id.substring(12);
                // console.log(id);
                // console.log(res);
                $('#elemento_id'+res+'').html('');
                elementos(idCategoria,res);
            });

            // Busca la existencia de los elementos que agrega a la solicitud
            $('#elemento_id'+cont+'').change(function(event){
                event.preventDefault();
                var idCategoria=$('#categoria_id'+cont+'').val();
                var idElemento=$('#elemento_id'+cont+'').val();
                var id = $(this).attr("id");
                var res = id.substring(11);
                // console.log(id);
                // console.log(res);
                // $('#elemento_id'+res+'').html('');
                existenciasElementos(idElemento,res);
            });

            // Valida que no se pueda pegar texto en el campo cantidad
            $('#cantidad'+cont+'').keyup(function(e) {
                if(isNaN(this.value + String.fromCharCode(e.charCode)))
                 return false;
                $key=$('#cantidad'+cont+'').val();
                
            })
            .on("cut copy paste",function(e){
                e.preventDefault();
            });
            var myInput = document.getElementById('cantidad'+cont+'');
                myInput.onpaste = function(e) {
                e.preventDefault();
                toastr["error"]("¡No se puede realizar esta acción!");
            }
            // Fin de la validacion de pegado en el campo cantidad
            // 
            $('#cantidad'+cont+'').keyup(function(e){
                $cantidad=$('#cantidad'+cont+'').val();
                $existencias=$('#existencias'+cont+'').val();
                // console.log($cantidad,$existencias);
                if (parseInt($cantidad) > parseInt($existencias)) {
                  $('#cantidad'+cont+'').val(1);
                  toastr["error"]("¡La cantidad supera las existencias!");
                }
            });

        });

        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
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

    function existenciasElementos(idElemento, res) {
        // $('#existencias'+res+'').html('');
        $.ajax({
            url: '/admin/elementos/existencias/'+idElemento+'',
            type: 'GET',
            dataType: 'JSON',
            success:function(data){
                console.log(data.cantidad);
                $('#existencias'+res+'').val(data.cantidad);
            }
        });
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
--}}
@endsection

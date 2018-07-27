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
        <li>
            <a href="{{ route('solicitudes.index') }}">
                Solcitudes
            </a>
        </li>
        <li class="">
            Editar
        </li>
        <li class="active">
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            @include('general.botonNuevo', ['modulo' => 'Editar Solicitud','ruta'=>''])
            {!! Form::model($solicitud, ['route'=>['solicitudes.update' ,$solicitud->id],'method'=>'PUT','files' => true ])!!}
            <input hidden="" id="idSolicitud" name="idSolicitud" type="text" value="{{ $solicitud->id }}"/>
            <input hidden="" id="idEspacio" name="idEspacio" type="text" value="{{ $solicitud->espacio->nombre }}"/>
            <input hidden="" id="idEsp" name="idEsp" type="text" value="{{ $solicitud->espacio->id }}"/>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-7" id="formulario">
                        {{--
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    {!! Form::label('area_id','Tipo de Espacio Academico') !!}
                                    <input class="form-control" name="" type="text" value="{{ $solicitud->espacio->area->nombre }}"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('espacio_id','Espacio Academico') !!}
                                    <input class="form-control" name="" type="text" value="{{ $solicitud->espacio->nombre }}"/>
                                </div>
                            </div>
                        </div>
                        --}}
                        @include('admins.solicitudes.fragmentos.form')
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
                <table class="table" id="dynamic_field">
                    <tbody>
                        @include('admins.solicitudes.fragmentos.agregarElementos')
                        <?php $cont = 1?>
                        @foreach ($solicitud->elementosSolicitud as $elemento)
                        <tr id="row<?php echo $cont ?>">
                            <td>
                                <select class="form-control" id="categoria_id<?php echo $cont ?>" name="categoria_id[]" placeholder="Selecciona una Categoria">
                                </select>
                            </td>
                            <td>
                                <select class="form-control" id="elemento_id<?php echo $cont ?>" name="elemento_id[]" placeholder="Selecciona un Elemento">
                                </select>
                            </td>
                            <td>
                                <input class="form-control" id="cantidad<?php echo $cont ?>" name="cantidad[]" placeholder="Cantidad de Elementos" type="text" value="">
                                </input>
                            </td>
                            <td>
                                <button class="btn btn-danger btn_remove btn-sm" id="<?php echo $cont ?>" name="remove" type="button">
                                    <span class="fa fa-trash">
                                    </span>
                                </button>
                            </td>
                        </tr>
                        <?php $cont++;?>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <button class="btn btn-primary btn-rounded waves-effect waves-light m-b-5" type="submit">
                    <i class="md md-check">
                    </i>
                    Guardar
                </button>
                <a class="btn btn-danger btn-rounded waves-effect waves-light m-b-5" href="{{ route('solicitudes.index') }}">
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
<script>
    $(document).ready(function() {
        var nombreE=$('#idEspacio').val();
        var idEsp=$('#idEsp').val();
        var idArea=$('#area_id').val();
        $('#espacio_id').append('<option id="BD" value="'+idEsp+'">'+nombreE+'</option>');
        espaciosAcademicos(idArea);
        
        $(document).on('change','#espacio_id',function(){
          var opcion = $(this).val();
          $('#espacio_id').each(function(){
              $('#espacio_id option[id="BD"]').remove();
          })
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
        //fin Datepicker

        // Eliminar formulario de registro
        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });
        // cierre del metodod e eliminar formulario

        var idE=$('#idSolicitud').val();
        var cont=0;
        console.log(idE);
        $('#fechaFin').change(function(){
            var fechaInicio=$('#fechaInicio').val();
            var fechaFin=$('#fechaFin').val()
            var diaI=fechaInicio.substring(0,2);
            var mesI=fechaInicio.substring(3,5);
            var diaF=fechaFin.substring(0,2);
            var mesF=fechaFin.substring(3,5);
            console.log(diaI +' '+ diaF +' '+ mesI +' '+mesF);
            if (diaF<diaI)
            {
                if (mesF<=mesI)
                {
                    toastr["warning"]('La fecha de finalizacion '+fechaFin+' no puede ser menor a la de inicio')
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
                    $('#fechaFin').val(fechaInicio);
                }
            }
        });
        var cont=0;
        $('#area_id').select2({
            placeholder: 'Selecciona un Area',
        });
        $('#espacio_id').select2({
          placeholder: 'Selecciona un Espacio Academico'
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
            console.log(value);
            infoEspacio(value);
           // elementosEspacio(value);
        });


        $.ajax({
            url: '/admin/solicitudes/detalles/'+idE,
            type: 'GET',
            dataType: 'JSON',
            success:function(datos){
                $.each(datos, function(i, item) {
                    cont++;
                    $('#categoria_id'+cont+'').append('<option value='+item.idC+'>'+item.nombreC+'</option>');

                    $('#elemento_id'+cont+'').append('<option value='+item.idE+'>'+item.nombreE+'</option>');

                    $('#cantidad'+cont+'').val(item.cantidad);
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
                }

                });

            }
        });

         $('#add').click(function(event) {
            cont++;

            categorias(cont);
            $('#dynamic_field').append('<tr id="row'+cont+'"><td><select class="form-control" id="categoria_id'+cont+'" name="categoria_id[]" placeholder="Selecciona una Categoria" style="width: 100%;" tabindex="-1"></select></td><td><select class="form-control" id="elemento_id'+cont+'" name="elemento_id[]" placeholder="Selecciona un Elemento" style="width: 100%;" tabindex="-1"></select></td><td><input class="form-control" id="cantidad'+cont+'" min="1" name="cantidad[]" pattern="^[0-9]+" type="text"  placeholder="Cantidad" style="width: 100%;"/></td><td><button type="button" name="remove" id="'+cont+'" class="btn btn-danger btn_remove btn-sm"><span class="fa fa-trash"></span></button></td></tr>');

            $('#categoria_id'+cont+'').append('<option>Selecciona una Categoria</option>');
            $('#elemento_id'+cont+'').append('<option>Selecciona un Elemento</option>');
            $('#categoria_id'+cont+'').select2({
            placeholder: 'Selecciona una Categoria',
            });
            $('#elemento_id'+cont+'').select2({
              placeholder: 'Selecciona un Elemento'
            });
            $('#categoria_id'+cont+'').change(function(event) {
                event.preventDefault();
                var idCategoria=$('#categoria_id'+cont+'').val();
                var idElemento=$('#elemento_id'+cont+'').val();
                console.log('Categoria '+idCategoria);
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
            }

        });

    });

    function espaciosAcademicos(idA)
    {
        $('#espacio_id').append('<option value="">Selecciona un Espacio Academico</option>');
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

    function categorias(cont) {

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

    function elementos(idCategoria,res) {
        console.log('contador elementos :'+res);
        console.log('categoria :'+idCategoria);
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
</script>
@endsection

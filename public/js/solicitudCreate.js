 $(document).ready(function() {
     //Timepicker
     $('#horaInicio').timepicker({
         showMeridian: false,
         showSeconds: true,
     });
     $('#horaFin').timepicker({
         showMeridian: false,
         showSeconds: true,
     });
     $('#fechaInicio').datepicker({
         format: 'dd-mm-yyyy',
         autoHide: true,
         autoPick: true,
         inline: true,
         language: 'es-mx'
     });
     $('#fechaFin').datepicker({
         format: 'dd-mm-yyyy',
         autoHide: true,
         autoPick: true,
         inline: true,
         language: 'es-mx'
     });
     // validacion que la fecha de termino no sea menor a la de inicio
     $('#horaFin').change(function() {
         $horaInicio = $('#horaInicio').val();
         $horaFin = $('#horaFin').val();
         if ($horaFin < $horaInicio) {
             toastr["warning"]('La hora de finalizacion no puede ser menor a la de inicio');
             $('#horaFin').val($horaInicio);
         }
     });
     $('#fechaFin').change(function() {
         var fechaInicio = $('#fechaInicio').val();
         var fechaFin = $('#fechaFin').val()
         var diaI = fechaInicio.substring(0, 2);
         var mesI = fechaInicio.substring(3, 5);
         var diaF = fechaFin.substring(0, 2);
         var mesF = fechaFin.substring(3, 5);
         if (diaF < diaI) {
             if (mesF <= mesI) {
                 toastr["warning"]('La fecha de finalizacion ' + fechaFin + ' no puede ser menor a la de inicio')
                 $('#fechaFin').val(fechaInicio);
             }
         }
     });
     var cont = 0;
     $('#area_id').select2({
         placeholder: 'Selecciona un Area',
     });
     $('#espacio_id').select2({
         placeholder: 'Selecciona un Espacio Academico'
     });
     $("#area_id").change(function() {
         var idA = $('#area_id').val();
         // console.log('Area : ' + idA);
         $('#datosEspacio').html('');
         $('#espacio_id').html('');
         $('#elementosEspacio').html('');
         espaciosAcademicos(idA);
     });
     $("#espacio_id").change(function() {
         var value = $('#espacio_id').val();
         if (value == 0) {
             $('#elementosEspacio').html('');
         }
         $('#elementosEspacio').html('');
         // console.log(value);
         infoEspacio(value);
         // elementosEspacio(value);
     });
     $('#add').click(function(event) {
         cont++;
         categorias(cont);
         $('#dynamic_field').append('<tr id="row' + cont + '"><td><select class="form-control" id="categoria_id' + cont + '" name="categoria_id[]" placeholder="Selecciona una Categoria" style="width: 100%;" tabindex="-1" required></select></td><td><select class="form-control" id="elemento_id' + cont + '" name="elemento_id[]" placeholder="Selecciona un Elemento" style="width: 100%;" tabindex="-1" required></select></td><td><input class="form-control" disabled id="existencias' + cont + '" min="1" name="existencias' + cont + '" placeholder="Existencias" /></td><td><input class="form-control" id="cantidad' + cont + '" min="1" name="cantidad[]" pattern="^[0-9]+" type="text"  placeholder="Cantidad a solicitar" style="width: 100%;" required/></td><td><button type="button" name="remove" id="' + cont + '" class="btn btn-danger btn_remove btn-sm"><span class="fa fa-trash"></span></button></td></tr>');
         $('#categoria_id' + cont + '').append('<option>Selecciona una Categoria</option>');
         $('#elemento_id' + cont + '').append('<option>Selecciona un Elemento</option>');
         $('#categoria_id' + cont + '').select2({
             placeholder: 'Selecciona una Categoria',
         });
         $('#elemento_id' + cont + '').select2({
             placeholder: 'Selecciona un Elemento'
         });
         $('#categoria_id' + cont + '').change(function(event) {
             event.preventDefault();
             var idCategoria = $('#categoria_id' + cont + '').val();
             var idElemento = $('#elemento_id' + cont + '').val();
             // console.log('Categoria ' + idCategoria);
             var id = $(this).attr("id");
             var res = id.substring(12);
             // console.log(res);
             $('#elemento_id' + res + '').html('');
             elementos(idCategoria, res);
         });
         $('#elemento_id' + cont + '').change(function(event) {
             event.preventDefault();
             var idCategoria = $('#categoria_id' + cont + '').val();
             var idElemento = $('#elemento_id' + cont + '').val();
             var id = $(this).attr("id");
             var res = id.substring(11);
             existenciasElementos(idElemento, res);
         });
         // Fin de la validacion de pegado en el campo cantidad
         //
         $('#cantidad' + cont + '').keyup(function(e) {
             $cantidad = $('#cantidad' + cont + '').val();
             $existencias = $('#existencias' + cont + '').val();
             // console.log($cantidad,$existencias);
             if (parseInt($cantidad) > parseInt($existencias)) {
                 $('#cantidad' + cont + '').val(1);
                 toastr["error"]("¡La cantidad supera las existencias!");
             }
         });
         $('#cantidad' + cont + '').keyup(function(e) {
             if (isNaN(this.value + String.fromCharCode(e.charCode))) return false;
             $key = $('#cantidad' + cont + '').val();
             // console.log($key);
         }).on("cut copy paste", function(e) {
             e.preventDefault();
         });
         var myInput = document.getElementById('cantidad' + cont + '');
         myInput.onpaste = function(e) {
             e.preventDefault();
             toastr["error"]("¡No se puede realizar esta acción!")
         }
     });
     $(document).on('click', '.btn_remove', function() {
         var button_id = $(this).attr("id");
         $('#row' + button_id + '').remove();
     });
 });

 function espaciosAcademicos(idA) {
     $('#espacio_id').append('<option>Selecciona un Espacio Academico</option>');
     $.ajax({
         url: '/admin/solicitudes/espacios/' + idA,
         type: 'GET',
         dataType: 'JSON',
         success: function(data) {
             // console.log(data);
             $.each(data, function(i, item) {
               if (item.disponible==0) {
                 $('#espacio_id').append('<option value='+item.id+'>'+item.nombre+'</option>');
               }else {
                 $('#espacio_id').append('<option disabled value='+item.id+'>'+item.nombre+' - no disponible</option>');
               }
                 // $('#espacio_id').append('<option value=' + item.id + '>' + item.nombre + '</option>');
             });
         }
     })
 }

 function infoEspacio(value) {
     $('#datosEspacio').html('');
     var url = '/admin/solicitudes/infoEspacio/' + value + '';
     $.ajax({
         url: url,
         type: 'GET',
         dataType: 'json',
         success: function(data) {
             // console.log(data);
             $('#datosEspacio').append('<p class="lead">' + data.nombre + '</p><p>' + data.ubicacion + '</p><p>' + data.descripcion + '</p><p></p>');
             elementosEspacio(value);
         },
     })
 }

 function elementosEspacio(value) {
     $('#elementosEspacio').html('');
     $.get('/admin/solicitudes/elementos-espacio/' + value, function(data) {
         if (data.length > 0 && value != 0) {
             $('#elementosEspacio').append('<p class="lead">Elementos con los que cuenta el <em>Espacio</em></p>');
             $.each(data, function(i, item) {
                 $('#elementosEspacio').append('<div class="col-md-6 col-sm-12 col-xs-6"><p><strong>Elemento: </strong>' + item.nombre + '</p>' + '<p><strong>Cantidad: </strong>' + item.cantidad + '</p></div>');
             });
         } else {
             // $('#elementosEspacio').append('<p class="lead text-center">Sin elementos asociados</p>');
         }
     });
 }
 // elementos adicionales
 function categorias(cont) {
     // $('#categoria_id'+cont+'').html('');
     $('#categoria_id' + cont + '').append('<option>Selecciona una Categoria</option>');
     $.ajax({
         url: '/admin/espacios/categorias-elementos/1',
         type: 'GET',
         dataType: 'JSON',
         success: function(data) {
             // console.log(data);
             $.each(data, function(i, item) {
                 $('#categoria_id' + cont + '').append('<option value=' + item.id + '>' + item.nombre + '</option>');
             });
         },
     });
 }

 function elementos(idCategoria, res) {
     // console.log(res);
     $('#elemento_id' + res + '').html('');
     $('#elemento_id' + res + '').append('<option>Selecciona un Elemento</option>');
     $.ajax({
         url: '/admin/espacios/elementos/' + idCategoria + '',
         type: 'GET',
         dataType: 'JSON',
         success: function(data) {
             // console.log(data);
             $.each(data, function(i, item) {
                 $('#elemento_id' + res + '').append('<option value=' + item.id + '>' + item.nombre + '</option>');
             });
         }
     })
 }

 function existenciasElementos(idElemento, res) {
     // $('#existencias'+res+'').html('');
     $.ajax({
         url: '/admin/elementos/existencias/' + idElemento + '',
         type: 'GET',
         dataType: 'JSON',
         success: function(data) {
             $('#existencias' + res + '').val(data.existencias);
         }
     });
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

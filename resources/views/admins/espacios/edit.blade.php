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
            <a href="{{ route('espacios.index') }}">
                Espacios Académicos
            </a>
        </li>
        <li class="">
            Editar
        </li>
        <li class="active">
            {{ $espacio->nombre }}
        </li>
    </ol>
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-edit"></i>
                    Editar espacio académico
                </h3>
                <div class="box-tools">
                    <a class="btn btn-link" href="{{ route('espacios.index')}}">
                        <span class="fa fa-mail-reply">
                        </span>
                        Volver
                    </a>
                </div>
            </div>
            {!! Form::model($espacio, ['route'=>['espacios.update' ,$espacio->id],'method'=>'PUT','files' => true ])!!}
            <input hidden="" id="idEspacio" name="idEspacio" type="text" value="{{ $espacio->id }}"/>
            <div class="box-body">
                @include('admins.espacios.fragmentos.form')
                <table class="table" id="dynamic_field">
                    <tbody>
                        @include('admins.espacios.fragmentos.agregarElementos')
                        <?php $cont = 1?>
                        @foreach ($espacio->elementos as $elemento)
                        <tr id="row<?php echo $cont ?>">
                            <td>
                                <select class="form-control" id="categoria_id<?php echo $cont ?>" name="categoria_id[]" placeholder="Selecciona una Categoria">
                                </select>
                            </td>
                            <td>
                                <select class="form-control" id="elemento_id<?php echo $cont ?>" name="elemento_id[]" placeholder="Selecciona un Elemento">
                                </select>
                            </td>
                            <td width="200px">
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
                <button class="btn btn-primary btn-rounded waves-effect waves-light m-b-5" id="guardar" name="guardar" type="submit">
                    <i class="fa fa-plus">
                    </i>
                    Guardar
                </button>
                <a class="btn btn-danger btn-rounded waves-effect waves-light m-b-5" href="{{ route('espacios.index') }}">
                    <i class="fa fa-remove">
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
        $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id");
            var espacio=$('#idEspacio').val();
            var el = $('#elemento_id' + button_id + '').val();
            alertify.confirm("Eliminar elemento","¿Seguro que desea eliminar el elemento asociado al espacio académico?",
            function(){
                $.ajax({
                    url: '/admin/espacios/editarEspacio/'+el+'/'+espacio,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data) {
                        $('#row'+button_id+'').remove();
                    }
                });
            },
            function(){
                alertify.notify('Sin acción')
            });           
        });


        var idE=$('#idEspacio').val();
        var cont=0;
        console.log(idE);
        $.ajax({
            url: '/admin/espacios/detalles/'+idE,
            type: 'GET',
            dataType: 'JSON',
            success:function(datos){
                $.each(datos, function(i, item) {
                    cont++;
                     // $('#categoria_id'+cont+'').select2();
                     // $('#elemento_id'+cont+'').select2();
                    $('#categoria_id'+cont+'').append('<option value='+item.idC+'>'+item.nombreC+'</option>');
                    $('#elemento_id'+cont+'').append('<option value='+item.idE+'>'+item.nombreE+'</option>');
                    $('#cantidad'+cont+'').val(item.cantidad);
                });
            }
        });

        $('#add').click(function(event) {
            cont++;
            categorias(cont);
            $('#dynamic_field').append('<tr id="row'+cont+'"><td><select class="form-control" id="categoria_id'+cont+'" name="categoria_id[]" placeholder="Selecciona una Categoria"></select></td><td><select class="form-control" id="elemento_id'+cont+'" name="elemento_id[]" placeholder="Selecciona un Elemento"></select></td><td><input class="form-control" id="cantidad'+cont+'" name="cantidad[]" placeholder="Cantidad de Elementos" type="number" value="" min="1" pattern="^[0-9]+"></input></td><td><button type="button" name="remove" id="'+cont+'" class="btn btn-danger btn_remove btn-sm"><span class="fa fa-trash"></span></button></td></tr>');

            $('#categoria_id'+cont+'').append('<option>Selecciona una Categoria</option>');
            $('#elemento_id'+cont+'').append('<option>Selecciona un Elemento</option>');
            // $('#categoria_id'+cont+'').select2({
            //     placeholder: 'Selecciona una Categoría'
            // });
            // $('#elemento_id'+cont+'').select2({
            //     placeholder: 'Selecciona un Elemento'
            // });
             $('#categoria_id'+cont+'').change(function(event) {
                event.preventDefault();
                var idCategoria=$('#categoria_id'+cont+'').val();
                var idElemento=$('#elemento_id'+cont+'').val();
                console.log('Categoria '+idCategoria);
                var id = $(this).attr("id");
                var res = id.substring(12);
                console.log('contador add :'+res);
                $('#elemento_id option').remove();
                elementos(idCategoria,res);
            });

        });

    });

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
</script>
@endsection

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
                Espacios Academicos
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
            @include('general.botonNuevo',['modulo' => 'Nuevo Espacio Academico','ruta'=>''])
            {!! Form::open(['route'=>'espacios.store', 'method'=>'POST','files' => true ]) !!}
            <div class="box-body">
                {!!Form::text('tipoCuenta', null, ['hidden','id'=>'tipoCuenta']) !!}
                    @include('admins.espacios.fragmentos.form')
            </div>
            <div class="box-body">
                <table class="table" id="dynamic_field">
                    {{--
                    <thead>
                        <tr>
                            <th scope="col">
                                {!! Form::label('categoria','Categoría') !!}
                            </th>
                            <th scope="col">
                                {!! Form::label('elemento_id', 'Elemento') !!}
                            </th>
                            <th scope="col">
                                {!! Form::label('cantidad', 'Cantidad:') !!}
                            </th>
                        </tr>
                    </thead>
                    --}}
                    <tbody>
                        @include('admins.espacios.fragmentos.agregarElementos')
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <button class="btn btn-primary btn-rounded waves-effect waves-light m-b-5" type="submit">
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

        var cont=0;
        categorias(cont);
        $('#add').click(function(event) {
            cont++;

            categorias(cont);
            $('#dynamic_field').append('<tr id="row'+cont+'"><td><select style="width: 100%;" tabindex="-1" class="form-control select2 select2-hidden-accessible" id="categoria_id'+cont+'" name="categoria_id[]" placeholder="Selecciona una Categoria"></select></td><td><select style="width: 100%;" tabindex="-1" class="form-control select2 select2-hidden-accessible" id="elemento_id'+cont+'" name="elemento_id[]" placeholder="Selecciona un Elemento"></select></td><td><input class="form-control" id="cantidad'+cont+'" name="cantidad[]" placeholder="Cantidad de Elementos" type="number" value="" min="1" pattern="^[0-9]+"></input></td><td><button type="button" name="remove" id="'+cont+'" class="btn btn-danger btn_remove btn-sm"><span class="fa fa-trash"></span></button></td></tr>');
            
            $('#categoria_id'+cont+'').append('<option>Selecciona una Categoria</option>'); 
            $('#elemento_id'+cont+'').append('<option>Selecciona un Elemento</option>'); 
            
            $('#categoria_id'+cont+'').select2({
                placeholder: 'Selecciona una Categoria'
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
            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });

        });
    });

    function categorias(cont) {
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

    function elementos(idCategoria,res) {
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
</script>
@endsection

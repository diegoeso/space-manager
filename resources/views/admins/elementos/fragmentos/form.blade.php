<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('nombre', 'Nombre') !!}
            {!! Form::text('nombre',null,['class'=>'form-control', 'placeholder' =>'Nombre'] ) !!}
            @if ($errors->has('nombre'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('nombre') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('numeroInventario', 'Numero de Inventario') !!}
            {!! Form::text('numeroInventario',null,['class'=>'form-control', 'placeholder' =>'Numero de Inventario'] ) !!}
            @if ($errors->has('numeroInventario'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('numeroInventario') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('categoria_id', 'Categoría') !!}
            {!! Form::select('categoria_id', $categorias, null, ['placeholder' => 'Selecciona una Categoría', 'class'=>'form-control']) !!}
            @if ($errors->has('categoria_id'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('categoria_id') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('descripcion', 'Descripción') !!}
            {!! Form::textArea('descripcion',null, ['class'=>'form-control','placeholder' =>'Descripción', 'size' => '40x4']) !!}
            @if ($errors->has('descripcion'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('descripcion') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
</div>

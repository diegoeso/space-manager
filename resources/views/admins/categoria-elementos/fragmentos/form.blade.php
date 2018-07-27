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
    {{--
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('permisos', 'Permisos') !!}
            {!! Form::text('permisos',null,['class'=>'form-control', 'placeholder' =>'Permisos'] ) !!}
            @if ($errors->has('permisos'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('permisos') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
    --}}
</div>
<div class="row">
    <div class="col-md-8">
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
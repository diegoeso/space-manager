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
        <div class="form-group">
            {!! Form::label('ubicacion','Ubicación') !!}
            {!! Form::text('ubicacion',null,['class'=>'form-control','placeholder'=>'Ubicación']) !!}
            @if ($errors->has('ubicacion'))
            <span class="label label-danger">
                {{ $errors->first('ubicacion') }}
            </span>
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('area_id','Área') !!}
            {!! Form::select('area_id', $areas, null, ['placeholder' => 'Selecciona un área', 'class'=>'form-control']) !!}
            @if ($errors->has('area_id'))
            <span class="label label-danger">
                {{ $errors->first('area_id') }}
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            {!! Form::label('descripcion', 'Descripción') !!}
            {!! Form::textArea('descripcion',null, ['class'=>'form-control','placeholder' =>'Descripción', 'size' => '60x8']) !!}
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

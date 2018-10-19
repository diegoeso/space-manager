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
</div>
<div class="row">
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

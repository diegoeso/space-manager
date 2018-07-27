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
            {!! Form::label('user_id','Responsable de área') !!}
            {!! Form::select('user_id', $responsables, null, ['placeholder' => 'Selecciona un responsable', 'class'=>'form-control','id'=>'user_id']) !!}
            @if ($errors->has('user_id'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('user_id') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('descripcion', 'Descripción') !!}
            {!! Form::textArea('descripcion',null, ['class'=>'form-control','placeholder' =>'Descripción', 'size' => '30x4']) !!}
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
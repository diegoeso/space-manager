<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('categoria_id','Tipo de Espacio Academico') !!}
            {!! Form::select('categoria_id', $categorias, null, ['placeholder' => 'Selecciona una Categoria', 'class'=>'form-control select2','id'=>'categoria_id','style'=>'width: 100%;','tabindex'=>'-1']) !!}
            @if ($errors->has('categoria_id'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('categoria_id') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('elemento_id','Elementos') !!}
            <select aria-hidden="true" class="form-control select2" id="elemento_id" name="elemento_id" style="width: 100%;" tabindex="-1">
            </select>
            @if ($errors->has('elemento_id'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('elemento_id') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('fecha', 'Fecha') !!}
            {!! Form::text('fecha', null, ['class'=>'form-control text-capitalize', 'placeholder' => 'Fecha', 'id'=>'fecha']) !!}
            @if ($errors->has('fecha'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('fecha') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group bootstrap-timepicker timepicker">
            {!! Form::label('horaInicio', 'Hora de finalizacion') !!}
            {!! Form::text('horaInicio', null, ['class'=>'form-control text-capitalize input-small', 'placeholder' => 'Hora de inicio', 'id'=>'horaInicio']) !!}
            @if ($errors->has('horaInicio'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('horaFin') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group bootstrap-timepicker timepicker">
            {!! Form::label('horaFin', 'Hora de finalizacion') !!}
            {!! Form::text('horaFin', null, ['class'=>'form-control text-capitalize input-small', 'placeholder' => 'Hora de finalizacion', 'id'=>'horaFin']) !!}
            @if ($errors->has('horaFin'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('horaFin') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('cantidad', 'Cantidad') !!}
            {!! Form::text('cantidad', null, ['class'=>'form-control', 'placeholder' => 'Cantidad','id'=>'cantidad', 'pattern'=>'^[0-9]+']) !!}
            @if ($errors->has('cantidad'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('cantidad') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
</div>

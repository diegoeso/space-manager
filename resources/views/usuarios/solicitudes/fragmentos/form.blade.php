<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('area_id','Tipo de Espacio Academico') !!}
            {!! Form::select('area_id', $areas, null, ['placeholder' => 'Selecciona un Espacio', 'class'=>'form-control select2','id'=>'area_id','style'=>'width: 100%;','tabindex'=>'-1']) !!}
            @if ($errors->has('area_id'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('area_id') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('espacio_id','Espacio Academico') !!}
            <select aria-hidden="true" class="form-control select2 select2-hidden-accessible" id="espacio_id" name="espacio_id" style="width: 100%;" tabindex="-1">
            </select>
            @if ($errors->has('espacio_id'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('espacio_id') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('fechaInicio', 'Fecha de Inicio') !!}
            {!! Form::text('fechaInicio', null, ['class'=>'form-control text-capitalize', 'placeholder' => 'Fecha de Inicio', 'id'=>'fechaInicio']) !!}
            @if ($errors->has('fechaInicio'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('fechaInicio') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('fechaFin', 'Fecha de Finalizacion') !!}
            {!! Form::text('fechaFin', null, ['class'=>'form-control text-capitalize', 'placeholder' => 'Fecha de Finalizacion', 'id'=>'fechaFin']) !!}
            @if ($errors->has('fechaFin'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('fechaFin') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        {{--
        <div class="input-group bootstrap-timepicker timepicker">
            {!! Form::label('horaInicio', 'Hora de inicio') !!}
            {!! Form::text('horaInicio', null, ['class'=>'form-control text-capitalize input-small', 'placeholder' => 'Hora de inicio','id'=>'horaInicio']) !!}
            @if ($errors->has('horaInicio'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('horaInicio') }}
                </strong>
            </span>
            @endif
        </div>
        --}}
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
    <div class="col-md-6">
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
            {!! Form::label('asistentesEstimados', 'Asistentes Estimados') !!}
            {!! Form::text('asistentesEstimados', null, ['class'=>'form-control', 'placeholder' => 'Asistentes Estimados','id'=>'asistentesEstimados', 'pattern'=>'^[0-9]+']) !!}
            @if ($errors->has('asistentesEstimados'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('asistentesEstimados') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('actividadAcademica', 'Actividad Academica') !!}
            {!! Form::textArea('actividadAcademica', null, ['class'=>'form-control', 'placeholder'=>'Actividad Academica','id'=>'actividadAcademica','size' => '30x4']) !!}
            @if ($errors->has('actividadAcademica'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('actividadAcademica') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
</div>

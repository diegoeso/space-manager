<input id="fechaI" name="fechaI" type="hidden">
</input>
<input id="fechaF" name="fechaF" type="hidden">
</input>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('rangoFechas','Rango de Fechas') !!}
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-clock-o">
                    </i>
                </div>
                {!! Form::text('rangoFechas', null, ['class'=>'form-control','id'=>'rangoFechas']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('diaSemana','Dia') !!}
            {!! Form::select('diaSemana', ['1'=>'Lunes','2'=>'Martes','3'=>'Miercoles','4'=>'Jueves','5'=>'Viernes','6'=>'Sabado'], null, ['placeholder' => 'Selecciona un dia', 'class'=>'form-control select2','id'=>'diaSemana','style'=>'width: 100%;','tabindex'=>'-1']) !!}
            @if ($errors->has('diaSemana'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('diaSemana') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-2">
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
    <div class="col-md-2">
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
    <div class="col-md-3">
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
    <div class="col-md-3">
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
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('carrera', 'Carrera') !!}
            {!! Form::select('carrera', ['1'=>'Ing. en Software','2'=>'Lic. en Seguridad Ciudadana','3'=>'Ing. en Producción Industrial','4'=>'Ing. en Plásticos'], null, ['class'=>'form-control select2','placeholder'=>'Selecciona una Carrera','id'=>'idCarrera','whidth'=>'100%','tabindex'=>'-1']) !!}
            @if ($errors->has('carrara'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('carrara') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('docente', 'Docente') !!}
            {!! Form::text('docente', null, ['class'=>'form-control', 'placeholder' => 'Docente','id'=>'docente']) !!}
            @if ($errors->has('docente'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('docente') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('semestre', 'Semestre') !!}
            {!! Form::text('semestre', null, ['class'=>'form-control', 'placeholder' => 'Semestre','id'=>'semestre']) !!}
            @if ($errors->has('semestre'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('semestre') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('grupo', 'Grupo') !!}
            {!! Form::text('grupo', null, ['class'=>'form-control', 'placeholder' => 'Grupo','id'=>'grupo']) !!}
            @if ($errors->has('grupo'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('grupo') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('actividadAcademica', 'Unidad de aprendizaje') !!}
            {!! Form::text('actividadAcademica', null, ['class'=>'form-control', 'placeholder'=>'Unidad de aprendizaje','id'=>'actividadAcademica']) !!}
            @if ($errors->has('actividadAcademica'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('actividadAcademica') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <select class="form-control" id="background" name="background">
                <option value="#26C6DA">
                    Azul Cielo
                </option>
                <option value="#FF5722">
                    Naranja
                </option>
                <option value="#FF3C6E">
                    Rosa
                </option>
                <option value="#FFCE39">
                    Amarillo
                </option>
                <option value="#679E02">
                    Verde
                </option>
                <option value="#D4091F">
                    Rojo
                </option>
                <option value="#830DD9">
                    Morado
                </option>
                <option value="#B1D84E">
                    Verde Limon
                </option>
                <option value="#012E57">
                    Azul Marino
                </option>
                <option value="#F2D1B3">
                    Carne
                </option>
            </select>
        </div>
    </div>
</div>
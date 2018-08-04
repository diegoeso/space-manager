<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('nombre', 'Nombre') !!}
            {!! Form::text('nombre', null, ['class'=>'form-control', 'placeholder' => 'Nombre (s)']) !!}
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
            {!! Form::label('apellidoP', 'Apellido Paterno') !!}
            {!! Form::text('apellidoP', null, ['class'=>'form-control', 'placeholder' => 'Apellido Paterno']) !!}
            @if ($errors->has('apellidoP'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('apellidoP') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('apellidoM', 'Apellido Materno') !!}
            {!! Form::text('apellidoM', null, ['class'=>'form-control', 'placeholder' => 'Apellido Materno']) !!}
            @if ($errors->has('apellidoM'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('apellidoM') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('telefono', 'Teléfono') !!}
            {!! Form::text('telefono', null, ['class'=>'form-control', 'placeholder'=>'Numero de Teléfono','id'=>'telefono']) !!}
            @if ($errors->has('telefono'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('telefono') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('nickname', 'Nombre de Usuario') !!}
            {!! Form::text('nickname', null, ['class'=>'form-control', 'placeholder' => 'Usuario','id'=>'nickname']) !!}
            @if ($errors->has('nickname'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('nickname') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('email', 'Correo Electrónico') !!}
            {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Correo Electrónico Institucional','id'=>'email']) !!}
            @if ($errors->has('email'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('email') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('password', 'Contraseña') !!}
            {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Contraseña']) !!}
            @if ($errors->has('password'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('password') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('password_confirmation', 'Confirmar Contraseña') !!}
            {!! Form::password('password_confirmation', ['class'=>'form-control', 'placeholder'=>'Confirmar Contraseña']) !!}
            @if ($errors->has('password_confirmation'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('password_confirmation') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('carrera', 'Carrera') !!}
            {!! Form::select('carrera', ['1'=>'Ing. en Software','2'=>'Lic. en Seguridad Ciudadana','3'=>'Ing. en Producción Industrial','4'=>'Ing. en Plásticos'], null, ['class'=>'form-control select2','placeholder'=>'Selecciona una Carrera','id'=>'idCarrera','whidth'=>'100%','tabindex'=>'-1']) !!}
            @if ($errors->has('carrera'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('carrera') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('semestre', 'Semestre') !!}
            
            {!! Form::select('semestre', [ '1'=>'1º Semestre', 
            '2'=>'2º Semestre', 
            '3'=>'3º Semestre', 
            '4'=>'4º Semestre', 
            '5'=>'5º Semestre', 
            '6'=>'6º Semestre', 
            '7'=>'7º Semestre', 
            '8'=>'8º Semestre', 
            '9'=>'9º Semestre', 
            '10'=>'10º Semestre',
            '11'=>'Catedrático',
            '12'=>'Maestría',
            '13'=>'Doctorado' ], null, ['class'=>'form-control','placeholder'=>'Selecciona un Semestre']) !!}
            
            @if ($errors->has('semestre'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('semestre') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('matricula', 'Num. de cuenta') !!}
            {!! Form::text('matricula', null, ['class'=>'form-control', 'placeholder' => 'Num. de cuenta']) !!}
            @if ($errors->has('matricula'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('matricula') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('foto', 'Fotografia') !!}
            <br/>
            <input class="form-control" id="foto" name="foto" onchange="readURL(this);" type="file"/>
            @if ($errors->has('foto'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('foto') }}
                </strong>
            </span>
            @endif
            <br/>
            <img alt="" height="200px" id="blah" src="" width="180px"/>
        </div>
    </div>
</div>

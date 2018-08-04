<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('nombre', 'Nombre') !!}
            {!! Form::text('nombre', null, ['class'=>'form-control text-capitalize', 'placeholder' => 'Nombre (s)']) !!}
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
            {!! Form::text('apellidoP', null, ['class'=>'form-control text-capitalize', 'placeholder' => 'Apellido Paterno']) !!}
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
            {!! Form::text('apellidoM', null, ['class'=>'form-control text-capitalize', 'placeholder' => 'Apellido Materno']) !!}
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
            {!! Form::text('telefono', null, ['class'=>'form-control', 'placeholder'=>'Teléfono']) !!}
             @if ($errors->has('telefono'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('telefono') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('email', 'Correo Electrónico') !!}
            {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Correo Electrónico']) !!}
             @if ($errors->has('email'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('email') }}
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
            {!! Form::label('foto', 'Fotografiá') !!}
            <br/>
            {{-- {!! Form::file('foto', ['class'=>'form-control']) !!} --}}
            <input class="form-control" name="foto" onchange="readURL(this);" type="file"/>
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
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('roles', 'Rol', ['class'=>'form-label']) !!}
            {!! Form::select('roles', $roles, null, ['class'=>'form-control','placeholder'=>'Seleccione un Rol','id'=>'idRol','style'=>'width:100%']) !!}
            @if ($errors->has('roles'))
            <span class="label label-danger">
                <strong>
                    {{ $errors->first('roles') }}
                </strong>
            </span>
            @endif
        </div>
    </div>
</div>

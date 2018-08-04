<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('name', 'Nombre') }}
            {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('slug', 'URL') }}
            {{ Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug']) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('description', 'Descripción') }}
            {{ Form::textarea('description', null, ['class' => 'form-control']) }}
        </div>
    </div>
</div>
<hr>
    <h3>
        Permiso especial
    </h3>
    <div class="form-group">
        <label>
            {{ Form::radio('special', 'all-access') }} Acceso total
        </label>
        <br/>
        <br/>
        <label>
            {{ Form::radio('special', 'no-access') }} Ningún acceso
        </label>
    </div>
    <hr>
        <h3>
            Lista de permisos
        </h3>
        <div class="form-group">
            <ul class="list-unstyled">
                @foreach($permissions as $permission)
                <li style="margin-top: 5px;">
                    <label>
                        {{ Form::checkbox('permissions[]', $permission->id, null) }}
                             {{ $permission->name }}
                        <em style="margin-left: 5px;">
                            ({{ $permission->description }})
                        </em>
                    </label>
                    <br/>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="form-group">
            {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
        </div>
    </hr>
</hr>
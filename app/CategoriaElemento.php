<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaElemento extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'permisos',
    ];
}

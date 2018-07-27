<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'user_id',
    ];

    public function responsables()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function espacios()
    {
        return $this->hasMany(Espacio::class);
    }
}

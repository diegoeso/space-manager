<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Espacio extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'ubicacion',
        'area_id',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function solicitud()
    {
        return $this->hasMany(Solicitudes::class);
    }

    public function elementos()
    {
        return $this->belongsToMany(Elemento::class)
            ->withPivot('elemento_id', 'cantidad', 'id');
    }
}

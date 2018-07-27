<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elemento extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'numeroInventario',
        'categoria_id',
        'cantidad',
    ];

    public function categoriaElemento()
    {
        return $this->belongsTo(CategoriaElemento::class, 'categoria_id');
    }

    public function solicitudes()
    {
        return $this->belongsToMany(Solicitudes::class);
    }

    public function espacio()
    {
        return $this->belongsToMany(Espacio::class)
            ->withPivot('espacio_id', 'cantidad');
    }

    public function elementoSolicitud()
    {
        return $this->belongsToMany(Solicitud::class)
            ->withPivot('solicitud_id', 'cantidad')
            ->withTimestamps();
    }
}

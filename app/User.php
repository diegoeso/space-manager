<?php

namespace App;

use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Date\Date;

class User extends Authenticatable
{
    use Notifiable, ShinobiTrait;

    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];
    //
    protected $fillable = [
        'nombre',
        'apellidoP',
        'apellidoM',
        'nickname',
        'email',
        'password',
        'confirmacion',
        'tipoCuenta',
        'telefono',
        'foto',
        'nombreCompleto',
        'password',
    ];

    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    public function getFullNameAttribute()
    {
        return $this->nombre . ' ' . $this->apellidoP . ' ' . $this->apellidoM;
    }

    public function area()
    {
        return $this->hasMany(Area::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getCreatedAtAttribute($date)
    {
        return new Date($date);
    }
}

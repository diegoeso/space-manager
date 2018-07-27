<?php

use App\CategoriaElemento;
use Faker\Generator as Faker;

$factory->define(App\CategoriaElemento::class, function (Faker $faker) {
    return [
        'nombre'      => $faker->randomElement(['Electronicos', 'Muebleria', 'Perifericos', 'Sonido', 'Video']),
        'descripcion' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'permisos'    => $faker->randomElement(['1', '2', '3']),
    ];
});

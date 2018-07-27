<?php

use App\Area;
use Faker\Generator as Faker;

$factory->define(App\Area::class, function (Faker $faker) {
    return [
        'nombre'      => $faker->randomElement(['Aula', 'Aula Digital', 'Salas de computo', 'Laboratorios', 'Talleres', 'Autoacceso', 'Modulo Cultural', 'Auditorio', 'Canchas Depostivas']),
        'descripcion' => $faker->text($maxNbChars = 200),
        'user_id'     => 2,
    ];
});

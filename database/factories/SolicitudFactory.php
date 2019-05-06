<?php

use Faker\Generator as Faker;

$factory->define(App\Solicitud::class, function (Faker $faker) {
    return [
        'fechaInicio'         => $faker->date($format = 'Y-m-d', $max = 'now'),
        'fechaFin'            => $faker->date($format = 'Y-m-d', $max = 'now'),
        'horaInicio'          => $faker->time($format = 'H:i:s', $max = 'now'),
        'horaFin'             => $faker->time($format = 'H:i:s', $max = 'now'),
        'actividadAcademica'  => $faker->text($maxNbChars = 800),
        'asistentesEstimados' => rand(1, 40),
        'tipoUsuario'         => rand(1, 3),
        'aproboSolicitud'     => 1,
        'usuarioSolicitud'    => rand(1, 100),
        'area_id'             => rand(1, 6),
        'espacio_id'          => rand(1, 10),
        'estado'              => rand(0, 3),
        'notificacion'        => $faker->randomElement(['0', '1']),
    ];
});

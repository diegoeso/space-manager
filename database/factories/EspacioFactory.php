<?php

use Faker\Generator as Faker;

$factory->define(App\Espacio::class, function (Faker $faker) {
    return [
        'nombre'      => $faker->randomElement(['Laboratorio de Diseño', 'Laboratorio de Desarrollo de Software', 'Laboratorio de Quimica', 'Laboratorio de Criminalistica', 'Laboratorio de Computo y Redes']),
        'descripcion' => $faker->text($maxNbChars = 250),
        'ubicacion'   => 'Edificio ' . $faker->randomElement(['A', 'B', 'C', 'D', 'F', 'G']),
        'area_id'     => rand(1, 6),
    ];
});

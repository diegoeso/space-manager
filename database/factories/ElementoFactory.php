<?php

use Faker\Generator as Faker;

$factory->define(App\Elemento::class, function (Faker $faker) {
    $elementos = rand(5, 50);
    return [
        'nombre'           => $faker->word,
        'descripcion'      => $faker->text($maxNbChars = 200),
        'numeroInventario' => $faker->numberBetween($min = 1000, $max = 900000),
        'categoria_id'     => rand(1, 5),
        'cantidad'         => $elementos,
        'solicitados'      => 0,
        'existencias'      => $elementos,
    ];
});

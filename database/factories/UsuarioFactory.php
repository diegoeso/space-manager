<?php
use App\Usuario;
use Faker\Generator as Faker;

$factory->define(App\Usuario::class, function (Faker $faker) {
    $nombre    = $faker->name;
    $apellidoP = $faker->lastName;
    $apellidoM = $faker->lastName;
    return [
        'nombre'             => $nombre,
        'apellidoP'          => $apellidoP,
        'apellidoM'          => $apellidoM,
        'nickname'           => $faker->userName,
        'email'              => $faker->unique()->safeEmail,
        'password'           => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'tipoCuenta'         => $faker->randomElement(['2', '3']),
        'telefono'           => $faker->numberBetween($min = 1000000000, $max = 9000000000),
        'carrera'            => rand(1, 4),
        'semestre'           => rand(1, 10),
        'matricula'          => rand(10, 10000000),
        'nombreCompleto'     => $nombre . ' ' . $apellidoP . ' ' . $apellidoM,
        'confirmacion'       => 1,
        'codigoConfirmacion' => null,
        'envioEmail'         => 1,
    ];
});

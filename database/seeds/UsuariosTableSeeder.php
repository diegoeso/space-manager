<?php

use App\Usuario;
use Illuminate\Database\Seeder;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Usuario::class, 300)->create();
        Usuario::create([
            'nombre'         => 'Alumno',
            'apellidoP'      => 'Alumno',
            'apellidoM'      => 'Alumno',
            'nickname'       => 'Alumno',
            'email'          => 'alumno@gmail.com',
            'password'       => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
            'telefono'       => '',
            'tipoCuenta'     => '3',
            'carrera'        => 'Ing. En Software',
            'semestre'       => '3 semestre',
            'matricula'      => '',
            'foto'           => 'user.png',
            'nombreCompleto' => 'Alumno',
            'confirmacion'   => '1',
            'envioEmail'     => '1',
        ]);

        Usuario::create([
            'nombre'         => 'Profesor',
            'apellidoP'      => 'Profesor',
            'apellidoM'      => 'Profesor',
            'nickname'       => 'Profesor',
            'email'          => 'profesor@gmail.com',
            'password'       => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
            'telefono'       => '7131150285',
            'tipoCuenta'     => '2',
            'carrera'        => '',
            'semestre'       => '',
            'matricula'      => '',
            'foto'           => 'user.png',
            'nombreCompleto' => 'Profesor',
            'confirmacion'   => '1',
            'envioEmail'     => '1',
        ]);
    }
}

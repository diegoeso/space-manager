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
            'email'          => 'alumno@gdsoft.com.mx',
            'password'       => bcrypt('secret'),
            'telefono'       => '',
            'tipoCuenta'     => '3',
            'carrera'        => '2',
            'semestre'       => '3',
            'matricula'      => '1228270',
            'nombreCompleto' => 'Alumno',
            'confirmacion'   => '1',
            'envioEmail'     => '1',
        ]);

        Usuario::create([
            'nombre'         => 'Profesor',
            'apellidoP'      => 'Profesor',
            'apellidoM'      => 'Profesor',
            'nickname'       => 'Profesor',
            'email'          => 'profesor@gdsoft.com.mx',
            'password'       => bcrypt('secret'),
            'telefono'       => '7131150285',
            'tipoCuenta'     => '2',
            'carrera'        => '',
            'semestre'       => '',
            'matricula'      => '',
            'nombreCompleto' => 'Profesor',
            'confirmacion'   => '1',
            'envioEmail'     => '1',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'nombre'         => 'Administrador',
            'apellidoP'      => 'Admin',
            'apellidoM'      => '',
            'nickname'       => 'Admin',
            'email'          => 'admin@gdsoft.com.mx',
            'password'       => bcrypt('secret'),
            'confirmacion'   => 1,
            'tipoCuenta'     => 0,
            'telefono'       => '',
            'foto'           => 'user.png',
            'nombreCompleto' => 'Administrador',
        ]);
        App\User::create([
            'nombre'         => 'Responsable de Área',
            'apellidoP'      => 'Responsable',
            'apellidoM'      => '',
            'nickname'       => 'Responsable',
            'email'          => 'responsable@gdsoft.com.mx',
            'password'       => bcrypt('secret'),
            'confirmacion'   => 1,
            'telefono'       => '',
            'tipoCuenta'     => 1,
            'foto'           => 'userM.png',
            'nombreCompleto' => 'Responsable de Área',
        ]);

    }
}

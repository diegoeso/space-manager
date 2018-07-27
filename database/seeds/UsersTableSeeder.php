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
            'nombre'         => 'Diego Enrique',
            'apellidoP'      => 'Sanchez',
            'apellidoM'      => 'Ordoñez',
            'nickname'       => 'diegokike68',
            'email'          => 'admin@gmail.com',
            'password'       => bcrypt('secret'),
            'confirmacion'   => 1,
            'tipoCuenta'     => 0,
            'telefono'       => '7131150285',
            'foto'           => 'user.png',
            'nombreCompleto' => 'Diego Enrique Sanchez Ordoñez',
        ]);

        // App\User::create([
        //     'nombre'         => 'Areli',
        //     'apellidoP'      => 'Fuentes',
        //     'apellidoM'      => 'Vega',
        //     'nickname'       => 'areli07',
        //     'email'          => 'areli@gmail.com',
        //     'password'       => bcrypt('secret'),
        //     'confirmacion'   => 1,
        //     'telefono'       => '7131150285',
        //     'tipoCuenta'     => 1,
        //     'foto'           => 'userM.png',
        //     'nombreCompleto' => 'Areli Fuentes Vega',
        // ]);

        App\User::create([
            'nombre'         => 'Nadia Michelle',
            'apellidoP'      => 'Sanchez',
            'apellidoM'      => 'Ordoñez',
            'nickname'       => 'mich',
            'email'          => 'responsable@gmail.com',
            'password'       => bcrypt('secret'),
            'confirmacion'   => 1,
            'telefono'       => '7131150285',
            'tipoCuenta'     => 1,
            'foto'           => 'userM.png',
            'nombreCompleto' => 'Nadia Michelle Sanchez Ordoñez',
        ]);

    }
}

<?php

use Caffeinated\Shinobi\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'        => 'Administrador',
            'slug'        => 'admin',
            'description' => 'Acceso total a todo el sistema',
            'special'     => 'all-access',
        ]);
        Role::create([
            'name'        => 'Responsable de Área',
            'slug'        => 'responsable-de-area',
            'description' => 'Acceso restringido a la elección del administrador.',
        ]);
        // admin
        $user = App\User::find(1);
        $user->roles()->attach(1);
        // responsable de área
        $user = App\User::find(2);
        $user->roles()->attach(2);

    }
}

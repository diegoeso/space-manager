<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsuariosTableSeeder::class);
        // $this->call(AreasTableSeeder::class);
        // $this->call(CategoriaElementosTableSeeder::class);
        // $this->call(ElementosTableSeeder::class);
        // $this->call(EspaciosTableSeeder::class);
        // $this->call(SolicitudesTableSeeder::class);
    }
}

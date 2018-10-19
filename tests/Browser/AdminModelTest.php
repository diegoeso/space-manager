<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminModelTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_mostrar_registros()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login')
                ->type('email', 'admin@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar');

            $browser->visit('/admin/users')
                ->assertSee('Listado de registros')
                ->screenshot('admin');
        });
    }

    public function test_crear_registro()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login')
                ->type('email', 'admin@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar');

            $browser->visit('/admin/users/crear')
                ->assertSee('Registrar administrador')
                ->screenshot('crear-admin')
                ->type('nombre', 'Enrique')
                ->type('apellidoP', 'Sanchez')
                ->type('apellidoM', 'Ordoñez')
                ->type('telefono', '7131150285')
                ->type('nickname', 'kike38')
                ->type('email', 'diego.sanchez@uaemex.mx')
                ->type('password', 'secret')
                ->type('password_confirmation', 'secret')
                ->select('roles','1')
                ->press('guardar')
                ->screenshot('store-admin');
        });
    }


    public function test_vista_ver_admin()
    {
        $id = (int)random_int(1, 2);
        $this->browse(function (Browser $first) use ($id) {
            $first->visit('/admin/login')
                ->type('email', 'admin@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar');

            $first->visit(route('users.show', $id))
                ->assertSee('Datos del usuario')
                ->screenshot('ver-admin');
        });
    }

    public function test_vista_editar_admin()
    {
        // $id = (int)random_int(1, 2);
        $id=1;
        $this->browse(function (Browser $first) use ($id) {
            $first->visit('/admin/login')
                ->type('email', 'admin@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar');

            $first->visit(route('users.edit', $id))
                ->assertSee('Editar usuario')
                ->screenshot('editar-admin')
                ->type('nombre', 'Diego Enrique')
                ->type('apellidoP', 'Sanchez')
                ->type('apellidoM', 'Perez')
                ->select('roles','2')
                ->screenshot('edit-data-admin')
                ->press('guardar')
                ->screenshot('edit-admin');
        });
    }


    // public function test_eliminar_usuario()
    // {
    //     $this->browse(function (Browser $first) {
    //         $first->visit('/admin/login')
    //             ->type('email', 'admin@gdsoft.com.mx')
    //             ->type('password', 'secret')
    //             ->press('entrar');
    //         $first->visit(route('users.destroy', 3));

    // }
}

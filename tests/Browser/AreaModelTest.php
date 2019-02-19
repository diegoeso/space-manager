<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AreaModelTest extends DuskTestCase
{
    //use DatabaseMigrations;
    /**
     * A Dusk test example.
     * @test
     * @return void
     */

    public function test_vista_listar_registros_areas()
    {
        $this->browse(function (Browser $first) {
            $first->visit('/admin/login')
                ->type('email', 'admin@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar');

            $first->visit('/admin/areas')
                ->assertSee('Listado de registros')
                ->screenshot('index-areas');
        });
    }

    public function test_vista_crear_nueva_area()
    {
        $this->browse(function (Browser $first) {
            $first->visit('/admin/login')
                ->type('email', 'admin@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar');

            $first->visit('/admin/areas/crear')
                ->assertSee('Registrar área')
                ->screenshot('create-areas');
        });
    }

    public function test_crear_nueva_area()
    {
        $this->browse(function (Browser $first) {
            $first->visit('/admin/login')
                ->type('email', 'admin@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar')
                ->screenshot('login-sesion');
            $first->visit('/admin/areas/crear')
                ->screenshot('crear-areas')
                ->assertSee('Registrar área')
                ->type('nombre', 'Laboratorios')
                ->select('user_id', '2')
                ->type('descripcion', 'Salas de laboratorios con equipos de computo')
                ->press('guardar')
                ->screenshot('store-areas');
        });
    }

    public function test_vista_ver_area()
    {
        $id = (int) random_int(1, 7);
        $this->browse(function (Browser $first) use ($id) {
            $first->visit('/admin/login')
                ->type('email', 'admin@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar');

            $first->visit(route('areas.show', $id))
                ->assertSee('Datos del área')
                ->screenshot('ver-area');
        });
    }

    public function test_vista_editar_area()
    {
        $id = (int) random_int(1, 7);
        $this->browse(function (Browser $first) use ($id) {
            $first->visit('/admin/login')
                ->type('email', 'admin@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar');

            $first->visit(route('areas.edit', $id))
                ->assertSee('Editar área')
                ->screenshot('editar-area')
                ->type('nombre', 'Laboratorios')
                ->select('user_id', '2')
                ->type('descripcion', 'Salas de laboratorios con equipos de computo')
                ->screenshot('edit-data-area')
                ->press('guardar')
                ->screenshot('edit-area');
        });
    }
}

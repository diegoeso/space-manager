<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EspaciosModelTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function test_vista_listar_registros_espacios()
    {
        $this->browse(function (Browser $first) {
            $first->visit('/admin/login')
                ->type('email', 'admin@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar');
            $first->visit('/admin/espacios')
                ->assertSee('Listado de registros')
                ->screenshot('index-espacios');
        });
    }

    public function test_crear_nuevo_espacio()
    {
        $this->browse(function (Browser $first) {
            $first->visit('/admin/login')
                ->type('email', 'admin@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar');
            $first->visit('/admin/espacios/crear')
                ->screenshot('crear-espacio')
                ->assertSee('Registrar espacio académico')
                ->type('nombre', 'Laboratorios')
                ->type('ubicacion', 'Edificio E')
                ->select('area_id', '4')
                ->type('descripcion', 'Salas de laboratorios con equipos de computo')
                ->press('guardar')
                ->screenshot('store-espacio');
        });
    }

    public function test_vista_ver_espacios()
    {
        $id = (int)random_int(1, 7);
        $this->browse(function (Browser $first) use ($id) {
            $first->visit('/admin/login')
                ->type('email', 'admin@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar');

            $first->visit(route('espacios.show', $id))
                ->assertSee('Datos del espacio académico')
                ->screenshot('ver-espacios');
        });
    }

    public function test_vista_editar_espacio()
    {
        $id = (int)random_int(1, 7);
        $this->browse(function (Browser $first) use ($id) {
            $first->visit('/admin/login')
                ->type('email', 'admin@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar');

            $first->visit(route('espacios.edit', $id))
                ->assertSee('Editar espacio académico')
                ->screenshot('editar-espacio')
                ->type('nombre', 'Laboratorios')
                ->type('ubicacion', 'Edificio E')
                ->select('area_id', '1')
                ->type('descripcion', 'Salas de laboratorios con equipos de computo')
                ->press('guardar')
                ->screenshot('edit-espacio');
        });
    }
}

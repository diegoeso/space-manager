<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ElementoModelTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function test_vista_listar_registros_elementos()
    {
        $this->browse(function (Browser $first) {
            $first->visit('/admin/login')
                ->type('email', 'admin@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar');

            $first->visit('/admin/elementos')
                ->assertSee('Listado de registros')
                ->screenshot('index-elementos');
        });
    }

    public function test_crear_nuevo_elemento()
    {
        $this->browse(function (Browser $first) {
            $first->visit('/admin/login')
                ->type('email', 'admin@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar');

            $first->visit('/admin/elementos/crear')
                ->screenshot('crear-elemento')
                ->assertSee('Registrar elemento')
                ->type('nombre', 'Proyectos Sony')
                ->select('categoria_id','3')
                ->type('numeroInventario', '12312312')
                ->type('descripcion', 'Dispositivos de video')
                ->press('guardar')
                ->screenshot('store-elemento');
        });
    }

    public function test_vista_ver_categoria()
    {
        $id = (int)random_int(1, 7);
        $this->browse(function (Browser $first) use ($id) {
            $first->visit('/admin/login')
                ->type('email', 'admin@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar');

            $first->visit(route('elementos.show', $id))
                ->assertSee('Datos del elemento')
                ->screenshot('ver-elemento');
        });
    }

    public function test_vista_editar_categoria()
    {
        $id = (int)random_int(1, 7);
        $this->browse(function (Browser $first) use ($id) {
            $first->visit('/admin/login')
                ->type('email', 'admin@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar');

            $first->visit(route('elementos.edit', $id))
                ->assertSee('Editar elemento')
                ->screenshot('editar-elemento')
                ->type('nombre', 'Proyectos Sony')
                ->select('categoria_id', '3')
                ->type('numeroInventario', '321312321')
                ->type('descripcion', 'Dispositivos de video')
                ->press('guardar')
                ->screenshot('edit-elemento');
        });
    }
}

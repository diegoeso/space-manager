<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoriaElementoModelTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    
    public function test_vista_listar_registros_categoria()
    {
        $this->browse(function (Browser $first) {
            $first->visit('/admin/login')
                ->type('email', 'admin@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar');

            $first->visit('/admin/categoria-elementos')
                ->assertSee('Listado de registros')
                ->screenshot('index-categorias');
        });
    }

    public function test_crear_nuevo_categoria()
    {
        $this->browse(function (Browser $first) {
            $first->visit('/admin/login')
                ->type('email', 'admin@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar');

            $first->visit('/admin/categoria-elementos/crear')
                ->screenshot('crear-categoria')
                ->assertSee('Registrar categoría')
                ->type('nombre', 'Video 2')
                ->type('descripcion', 'Dispositivos de video')
                ->press('guardar')
                ->screenshot('store-categoria');
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

            $first->visit(route('categoria-elementos.show', $id))
                ->assertSee('Datos de la categoría')
                ->screenshot('ver-categoria');
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

            $first->visit(route('categoria-elementos.edit', $id))
                ->assertSee('Editar categoría')
                ->screenshot('editar-categoria')
                ->type('nombre', 'Video 2')
                ->type('descripcion', 'Dispositivos de video')
                ->press('guardar')
                ->screenshot('edit-categoria');
        });
    }
}

<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Usuario;

class UsuarioModelTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function test_vista_listar_registros_usuarios()
    {
        $this->browse(function (Browser $first) {
            $first->visit('/admin/login')
                ->type('email', 'admin@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar');
            
            $first->visit('/admin/usuarios')
                ->assertSee('Listado de registros')
                ->screenshot('index-usuarios');
        });
    }

    public function test_vista_crear_nuevo_usuario()
    {
        $this->browse(function (Browser $first) {
            $first->visit('/admin/login')
                ->type('email', 'admin@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar');

            $first->visit('/admin/usuarios/crear')
                ->assertSee('Registrar usuario')
                ->screenshot('create-usuarios');
        });
    }
    
    public function test_crear_nuevo_usuario()
    {
        $this->browse(function (Browser $first) {
            $first->visit('/admin/login')
                ->type('email', 'admin@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar')
                ->screenshot('login-sesion');
            $first->visit('/admin/usuarios/crear')
                ->screenshot('crear-usuarios')
                ->assertSee('Registrar usuario')
                ->type('nombre','Enrique')
                ->type('apellidoP','Sanchez')
                ->type('apellidoM','Ordoñez')
                ->type('telefono','7131150285')
                ->type('nickname','kike68')
                ->type('email','diego.sanchez@uaemex.mx')
                ->type('password','secret')
                ->type('password_confirmation','secret')
                ->type('matricula','1228270')
                ->press('guardar')
                ->screenshot('store-usuarios');
        });
    }
    
    public function test_vista_ver_usuario()
    {
        $id= (int)random_int(1,302);
        $this->browse(function (Browser $first) use ($id) {
            $first->visit('/admin/login')
                ->type('email', 'admin@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar');

            $first->visit(route('usuarios.show',$id))
                ->assertSee('Datos del usuario')
                ->screenshot('ver-usuario');
        });
    }

    public function test_vista_editar_usuario()
    {
        $id= (int)random_int(1,302);
        $this->browse(function (Browser $first) use ($id) {
            $first->visit('/admin/login')
                ->type('email', 'admin@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar');

            $first->visit(route('usuarios.edit',$id))
                ->assertSee('Editar usuario')
                ->screenshot('editar-usuario')
                ->type('nombre', 'Diego Enrique')
                ->type('apellidoP','Sanchez')
                ->type('apellidoM','Perez')
                ->screenshot('edit-data-usuario')
                ->press('guardar')
                ->screenshot('edit-usuario');
        });
    }

    // public function test_eliminar_usuario()
    // {
    //     $id = (int)random_int(1, 302);
    //     $id=1;
    //     $this->browse(function (Browser $first) use ($id) {
    //         $first->visit('/admin/login')
    //             ->type('email', 'admin@gdsoft.com.mx')
    //             ->type('password', 'secret')
    //             ->press('entrar');
    //         $first->visit(route('usuarios.destroy', $id))
    //             ->assertSee('Listado de Usuarios')
    //             ->screenshot('Eliminar-usuario');
    //     });
    // }
}

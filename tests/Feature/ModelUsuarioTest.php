<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Usuario;
use Session;
use App\User;
class ModelUsuarioTest extends TestCase
{
    /**
     * A basic test example.
     * @test
     * @return void
     */
    // public function testsetUp()
    // {
    //     parent::setUp(); // performs set up

    //     Session::start(); // starts session, this is what handles csrf token part

    //     $user = User::find(1);

    //     $this->be($user);
    // }

    // public function test_eliminar_usuario()
    // {
    //     $response = $this->call('DELETE', '/admin/usuarios/307', ['_token' => csrf_token()]);
    //     $this->assertEquals(302, $response->getStatusCode());
    // }
    public function loginWithWrongCredentials()
    {
        $this->get('/login')
            ->assertSee('Space Manager')
            ->type('alumno@gdsoft.com.mx', 'email')
            ->type('secret', 'password')
            ->press('entrar')
            ->seePageIs('/inicio');
    }
}

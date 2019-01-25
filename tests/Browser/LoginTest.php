<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    // use DatabaseMigrations;
    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function test_inicio_de_sesion()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login')
                ->type('email', 'admin@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar')
                ->screenshot('login-admin')
                ->assertPathIs('/admin');
        });
    }

    public function test_registro_nuevo_usuario()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('nombre', 'Diego')
                ->type('apellidoP', 'Sanchez')
                ->type('apellidoM', 'Ordoñez')
                ->type('email', 'diego.enrique1907@gmail.com')
                ->type('password', 'secret')
                ->type('password_confirmation', 'secret')
                ->press('registro')
                ->screenshot('registro')
                ->assertPathIs('/confirmacion-de-cuenta');
        });
    }

    public function test_confirmacion_de_cuenta()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('confirmacion/diego.enrique1907@gmail.com/token/Om2LsxaLTdFG5oZjBpblUv4NJyWhk7KCldPelUOkzCGdz')
                ->screenshot('confirmacion');
        });
    }
}

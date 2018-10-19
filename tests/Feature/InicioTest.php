<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InicioTest extends TestCase
{
    /**
     * @test
     */
    function pagina_de_inicio()
    {
        $this->get('/')
        ->assertStatus(200)
        ->assertSee('Space Manager')
        ->assertSee('Eventos')
        ->assertSee('Registro')
        ->assertSee('Iniciar Sesión')
        ->assertSee('Registrarse')
        ->assertViewIs('welcome');
    }
}

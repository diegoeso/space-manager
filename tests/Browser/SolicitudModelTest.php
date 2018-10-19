<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SolicitudModelTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_vista_mostrar_solicitudes()
    {

        $this->browse(function (Browser $first) {
            $first->visit('/login')
                ->type('email', 'alumno@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar');

            $first->visit(route('solicitud.index'))
                ->assertSee('Listado de Solicitudes')
                ->screenshot('usuario-solicitud');
        });
    }


    public function test_registrar_solicitud()
    {
        $this->browse(function (Browser $first) {
            $first->visit('/login')
                ->type('email', 'alumno@gdsoft.com.mx')
                ->type('password', 'secret')
                ->press('entrar');

            $first->visit(route('solicitud.create'))
                ->assertSee('Registrar solicitud')
                ->screenshot('usuario-solicitud-create')
                ->select('area_id','1')
                ->select('espacio_id','1')
                ->type('fechaInicio', '2018/09/27')
                ->type('fechaFin', '2018/09/27')
                ->type('horaInicio', '07:00:00')
                ->type('horaFin', '10:00:00')
                ->type('asistentesEstimados','1')
                ->type('actividadAcademica','Actividad de laboratorio')
                ->press('guardar')
                ->screenshot('store-solicitud');
        });
    }
}

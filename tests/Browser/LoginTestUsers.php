<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTestUsers extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function login_test_users()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('Space Manager')
                ->screenshot('otro');
        });
    }
}

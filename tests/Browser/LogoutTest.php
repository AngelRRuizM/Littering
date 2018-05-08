<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LogoutTest extends DuskTestCase
{
    /**
     * The session does not contain a logged user.
     *
     * @return void
     */
    public function testNoUserAuthenticatedLogout()
    {   
        $this->browse(function ($browser) {
            $browser->visit('/')
                    ->assertTitle('Littering')
                    ->assertDontSee('Cerrar sesión');
        });
    }

    /**
     * The session does contain a logged user.
     *
     * @return void
     */
    public function testValidLogout()
    {
        $user = User::first();
        
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->assertTitle('Littering')
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->press('#login')
                    ->waitForLocation('/usuario')
                    ->press('#logout')
                    ->waitForLocation('/');
        });
    }
}

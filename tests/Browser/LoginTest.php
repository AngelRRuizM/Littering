<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * The input does not contain an email.
     *
     * @return void
     */
    public function testNullEmail()
    {
        $user = User::first();
        
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->assertTitle('Littering')
                    ->type('email', null)
                    ->type('password', 'secret')
                    ->press('#login')
                    ->assertPathIs('/login');
        });
    }

    /**
     * The input does not contain a password
     *
     * @return void
     */
    public function testNullPassword()
    {
        $user = User::first();
        
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->assertTitle('Littering')
                    ->type('email', 'user@littering.com')
                    ->type('password', null)
                    ->press('#login')
                    ->assertPathIs('/login');
        });
    }

    /**
     * The email does not contains “@domain”.
     *
     * @return void
     */
    public function testNotValidEmail()
    {
        $user = User::first();
        
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->assertTitle('Littering')
                    ->type('email', 'user.littering.com')
                    ->type('password', 'secret')
                    ->press('#login')
                    ->assertPathIs('/login');
        });
    }

    /**
     * The email does not belong to any user.
     *
     * @return void
     */
    public function testNotRegisteredEmail()
    {
        $user = User::first();
        
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->assertTitle('Littering')
                    ->type('email', 'notregistered@littering.com')
                    ->type('password', 'secret')
                    ->press('#login')
                    ->assertPathIs('/login');
        });
    }

    /**
     * The email exists but the password is incorrect.
     *
     * @return void
     */
    public function testIncorrectPasswordLogin()
    {
        $user = User::first();
        
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->assertTitle('Littering')
                    ->type('email', $user->email)
                    ->type('password', 'incorrect')
                    ->press('#login')
                    ->assertPathIs('/login');
        });
    }

    /**
     * Test valid login.
     *
     * @return void
     */
    public function testValidLogin()
    {
        $user = User::first();
        
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->assertTitle('Littering')
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->press('#login')
                    ->assertPathIs('/usuario');
        });
    }
}

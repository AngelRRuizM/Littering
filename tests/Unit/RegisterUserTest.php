<?php

namespace Tests\Unit;

use App;
use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Controllers\Auth\RegisterController;

class RegisterUserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * The input does not contain a name.
     *
     * @return void
     */
    public function testNullName()
    {
        $registerController = App::make('App\Http\Controllers\Auth\RegisterController');
        
        $this->assertTrue($registerController->validator([
            'name' => null,
            'email' => 'newUser@littering.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ])->fails());
    }

    /**
     * The input does not contain an email.
     *
     * @return void
     */
    public function testNullEmail()
    {
        $registerController = App::make('App\Http\Controllers\Auth\RegisterController');
        
        $this->assertTrue( $registerController->validator([
            'name' => 'User name',
            'email' => null,
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ])->fails());
    }


    /**
     * The input does not contain a password.
     *
     * @return void
     */
    public function testNullPassword()
    {
        $registerController = App::make('App\Http\Controllers\Auth\RegisterController');
        
        $this->assertTrue( $registerController->validator([
            'name' => 'User name',
            'email' => 'newUser@littering.com',
            'password' => null,
            'password_confirmation' => 'secret'
        ])->fails());
    }
    
    /**
     * The input does not contain a password confirmation that matches the password field.
     *
     * @return void
     */
    public function testNotMatchingPasswordConfirmation()
    {
        $registerController = App::make('App\Http\Controllers\Auth\RegisterController');
        
        $this->assertTrue( $registerController->validator([
            'name' => 'User name',
            'email' => 'newUser@littering.com',
            'password' => 'secret',
            'password_confirmation' => 'not matching'
        ])->fails());
    }

    /**
     * The name is 51 characters long.
     *
     * @return void
     */
    public function testNotValidTopBoundaryNameLength()
    {
        $registerController = App::make('App\Http\Controllers\Auth\RegisterController');
        
        $this->assertTrue( $registerController->validator([
            'name' => 'abcdefghijklmnopqrstuvwxyzabcdefghijqlmnopqrstuvxyz',
            'email' => 'newUser@littering.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ])->fails());
    }

    /**
     * The name is 0 characters long.
     *
     * @return void
     */
    public function testNotValidLowBoundaryNameLength()
    {
        $registerController = App::make('App\Http\Controllers\Auth\RegisterController');
        
        $this->assertTrue( $registerController->validator([
            'name' => '',
            'email' => 'newUser@littering.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ])->fails());
    }

    /**
     * The name is 50 characters long.
     *
     * @return void
     */
    public function testValidTopBoundaryNameLength()
    {
        $registerController = App::make('App\Http\Controllers\Auth\RegisterController');
        $this->assertFalse( $registerController->validator([
            'name' => 'abcdefghijklmnopqrstuvwxyzabcdefghijqlmnopqrstuvxy',
            'email' => 'newUser@littering.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ])->fails());
    }

    /**
     * The name is 1 characters long.
     *
     * @return void
     */
    public function testValidLowBoundaryNameLength()
    {
        $registerController = App::make('App\Http\Controllers\Auth\RegisterController');
        
        $this->assertFalse( $registerController->validator([
            'name' => 'a',
            'email' => 'newUser@littering.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ])->fails());
    }

    /**
     * The password is 51 characters long.
     *
     * @return void
     */
    public function testNotValidTopBoundaryPasswordLength()
    {
        $registerController = App::make('App\Http\Controllers\Auth\RegisterController');
        
        $this->assertTrue( $registerController->validator([
            'name' => 'User name',
            'email' => 'newUser@littering.com',
            'password' => 'abcdefghijklmnopqrstuvwxyzabcdefghijqlmnopqrstuvxyz',
            'password_confirmation' => 'abcdefghijklmnopqrstuvwxyzabcdefghijqlmnopqrstuvxyz'
        ])->fails());
    }

    /**
     * The password is 3 characters long.
     *
     * @return void
     */
    public function testNotValidLowBoundaryPasswordLength()
    {
        $registerController = App::make('App\Http\Controllers\Auth\RegisterController');
        
        $this->assertTrue( $registerController->validator([
            'name' => '',
            'email' => 'newUser@littering.com',
            'password' => 'pas',
            'password_confirmation' => 'pas'
        ])->fails());
    }

    /**
     * The password is 50 characters long.
     *
     * @return void
     */
    public function testValidTopBoundaryPasswordLength()
    {
        $registerController = App::make('App\Http\Controllers\Auth\RegisterController');
        $this->assertFalse( $registerController->validator([
            'name' => 'User name',
            'email' => 'newUser@littering.com',
            'password' => 'abcdefghijklmnopqrstuvwxyzabcdefghijqlmnopqrstuvxy',
            'password_confirmation' => 'abcdefghijklmnopqrstuvwxyzabcdefghijqlmnopqrstuvxy'
        ])->fails());
    }

    /**
     * The password is 4 characters long.
     *
     * @return void
     */
    public function testValidLowBoundaryPasswordLength()
    {
        $registerController = App::make('App\Http\Controllers\Auth\RegisterController');
        
        $this->assertFalse( $registerController->validator([
            'name' => 'User name',
            'email' => 'newUser@littering.com',
            'password' => 'pass',
            'password_confirmation' => 'pass'
        ])->fails());
    }

    /**
     * The email is 101 characters long.
     *
     * @return void
     */
    public function testNotValidTopBoundaryEmailLength()
    {
        $registerController = App::make('App\Http\Controllers\Auth\RegisterController');
        
        $this->assertTrue( $registerController->validator([
            'name' => 'User name',
            'email' => 'abcdefghijklmnopqrstuvwxyzabcdefghijqlmnopqrstuvxyabcdefghijkl@littering.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ])->fails());
    }

    /**
     * The email is 0 characters long.
     *
     * @return void
     */
    public function testNotValidLowBoundaryEmailLength()
    {
        $registerController = App::make('App\Http\Controllers\Auth\RegisterController');
        
        $this->assertTrue( $registerController->validator([
            'name' => 'User name',
            'email' => '',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ])->fails());
    }
    
    /**
     * The email is 100 characters long.
     *
     * @return void
     */
    public function testValidTopBoundaryEmailLength()
    {
        $registerController = App::make('App\Http\Controllers\Auth\RegisterController');
        
        $this->assertFalse( $registerController->validator([
            'name' => 'User name',
            'email' => 'abcdefghijklmnopqrstuvwxyzabcdefghijqlmnopqrstuvxyabcdefghijk@littering.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ])->fails());
    }

    /**
     * The email does not contain “@domain”.
     *
     * @return void
     */
    public function testNotValidEmailFormat()
    {
        $registerController = App::make('App\Http\Controllers\Auth\RegisterController');
        
        $this->assertTrue( $registerController->validator([
            'name' => 'User name',
            'email' => 'user_gmail.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ])->fails());
    }

    /**
     * The email contains “@domain”.
     *
     * @return void
     */
    public function testValidEmailFormat()
    {
        $registerController = App::make('App\Http\Controllers\Auth\RegisterController');
        
        $this->assertFalse( $registerController->validator([
            'name' => 'User name',
            'email' => 'newUser@littering.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ])->fails());
    }

    /**
     * The email is already related to an existent user
     *
     * @return void
     */
    public function testAlreadyRegisteredEmail()
    {
        $registerController = App::make('App\Http\Controllers\Auth\RegisterController');
        
        $this->assertTrue( $registerController->validator([
            'name' => 'User name',
            'email' => 'user@littering.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ])->fails());
    }

    /**
     * The email is not related to an existent user
     *
     * @return void
     */
    public function testNotRegisteredEmail()
    {
        $registerController = App::make('App\Http\Controllers\Auth\RegisterController');
        
        $this->assertFalse( $registerController->validator([
            'name' => 'User name',
            'email' => 'newUser@littering.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ])->fails());
    }

    /**
     * All data is valid, the user is in the database.
     *
     * @return void
     */
    public function testValidRegisterUser()
    {
        $registerController = App::make('App\Http\Controllers\Auth\RegisterController');
        $data = [
            'name' => 'User name',
            'email' => 'newUser@littering.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ];

        $validator = $registerController->validator($data);

        if($validator->fails()){
            $this->fail('Should have passed all validations.');
        }

        unset($data['password_confirmation']);
        $user = $registerController->create($data);

        if($retrieved = User::find($user->id)){
            $this->assertEquals($data['name'], $retrieved->name);
            $this->assertEquals($data['email'], $retrieved->email);
            $this->assertTrue(Hash::check($data['password'], $retrieved->password));
        }
        else{
            $this->fail('User not found in the database');
        }
    }
}

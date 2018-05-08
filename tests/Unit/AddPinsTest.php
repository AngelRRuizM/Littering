<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Pin;
use App\User;

class AddPinsTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * The pin is valid
     *
     * @return void
     */
    public function testValidPin()
    {
        $this->assertFalse(Pin::validate([
            'residue_type_id' => 1,
            'location_id' => 1
        ])->fails());
        $user = User::find(1);
        $this->assertNotEquals($user, null);
        
        $x = [
            'residue_type_id' => 1,
            'location_id' => 1,
            'user_id'=> 1
        ];
        $pin = Pin::create($x);
        $this->assertNotEquals(Pin::find($pin->id), null);
    }

    /**
     * The pin refernces a user that doesn't exists
     *
     * @return void
     */
    public function testInvalidUser()
    {
        $this->assertFalse(Pin::validate([
            'residue_type_id' => 1,
            'location_id' => 1
        ])->fails());
        $user = User::find(0);
        $this->assertEquals($user, null);
    }

    /**
     * The pin refernces a location that does not exists
     *
     * @return void
     */
    public function testInvalidLocation()
    {
        $this->assertTrue(Pin::validate([
            'residue_type_id' => 1,
            'location_id' => 0
        ])->fails());
        $user = User::find(1);
        $this->assertNotEquals($user, null);
    }

     /**
     * The pin refernces a  that does not exists
     *
     * @return void
     */
    public function testInvalidResidue()
    {
        $this->assertTrue(Pin::validate([
            'residue_type_id' => 0,
            'location_id' => 1
        ])->fails());
        $user = User::find(1);
        $this->assertNotEquals($user, null);
    }

}

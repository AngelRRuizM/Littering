<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Pins;
use App\User;

class RetrievePinsTest extends TestCase
{
    use DatabaseTransactions;


    /*
     * The user has no pins
     *
     * @return void
     */
    public function testEmptyPins(){
        $user = User::find(2);

        $this->assertFalse($user===null);
        
        $pins = $user->pins;
        $this->assertTrue(sizeof($pins)==0);
    }


    /*
     * The user has at least one pin
     *
     * @return void
     */
    public function testNonEmptyPins(){
        $user = User::find(1);
        //Make sure user exists
        $this->assertFalse($user===null);
        $pins = $user->pins;
        $this->assertTrue(sizeof($pins) != 0);
    }
}

?>

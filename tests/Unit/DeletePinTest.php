<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Pin;

class DeletePinTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test for deleting a pin that does not exist
     *
     * @return void
     */
    public function testDeleteNonExistingPin()
    {
        $pin=Pin::find(100);
        //Make sure pin does not exist
        $this->assertTrue($pin===null);
        $result=Pin::destroy(100); 
        $this->assertTrue($result===0);
    }

    public function testDeleteExistingPin(){
        $pin=Pin::find(1);
        //Make sure pin exists
        $this->assertFalse($pin===null);
        //Destroy pin, make sure the returned value says so.
        $result=Pin::destroy(1);
        $this->assertTrue($result===1);
        
    }
    
}

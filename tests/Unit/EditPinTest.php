<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Pin;

class EditPinTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test for deleting a pin that does not exist
     *
     * @return void
     */
    public function testEditNonExistingPin()
    {
        $pin=Pin::find(100);
        //Make sure pin does not exist
        $this->assertTrue($pin===null);
    }

    public function testEditExistingResidueType(){
        $pin=Pin::find(1);
        //Make sure pin exists
        $this->assertFalse($pin===null);
        //Make sure residue_type_id was not 2
        $this->assertFalse($pin->residue_type_id===2);
        $pin->residue_type_id = 2;
        $pin->save();
        //Get same pin but in different variable (to make sure change in DB was made)
        $newPin=Pin::find(1);
        //Make sure residue_type_id changed
        $this->assertTrue($newPin->residue_type_id===2);
    }

    public function testEditExistingLocation(){
        $pin=Pin::find(1);
        //Make sure pin exists
        $this->assertFalse($pin===null);
        //Make sure location_id was not 2
        $this->assertFalse($pin->location_id===2);
        $pin->location_id = 2;
        $pin->save();
        //Get same pin but in different variable (to make sure change in DB was made)
        $newPin=Pin::find(1);
        //Make sure locationid changed
        $this->assertTrue($newPin->location_id===2);
    }

    public function testEditNonExistingResidueType(){
        $pin=Pin::find(1);
        //Make sure pin exists
        $this->assertFalse($pin===null);
        $pin->residue_type_id = 0;
        //Put pin in array because that's expected input to create validator
        $array=[$pin];
        $validator = Pin::validate($array);
        //Make sure validator fails
        $this->assertTrue($validator->fails());
    }

    public function testEditNonExistingLocation(){
        $pin=Pin::find(1);
        //Make sure pin exists
        $this->assertFalse($pin===null);
        $pin->location = 0;
        //Put pin in array because that's expected input to create validator
        $array=[$pin];
        $validator = Pin::validate($array);
        //Make sure validator fails
        $this->assertTrue($validator->fails());
    }
    
}

<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Location;
use App\User;

class RetrieveLocationsTest extends TestCase
{
    use DatabaseTransactions;

    public function testEmptyLocations(){
        $user = User::find(2);
        //Make sure user exists
        $this->assertFalse($user===null);
        //$locations should be empty
        $locations = $user->locations;
        $this->assertTrue(sizeof($locations)==0);
    }

    public function testNonEmptyLocations(){
        $user = User::find(1);
        //Make sure user exists
        $this->assertFalse($user===null);
        //$locations are retrieved the way they are in the website.
        $locations = $user->locations;
        $firstCount = sizeof($locations);

        $allLocationsFiltered = Location::all();
        $secondCount = 0;
        //Manually count valid locations
        foreach ($allLocationsFiltered as $location) {
            if ($location->user_id===1) {
                $secondCount = $secondCount + 1;
            }
        }
        $this->assertTrue($firstCount === $secondCount);
    }
}

?>

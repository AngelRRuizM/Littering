<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Location;

class DeleteLocationTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * Delete a location that exists
     *
     * @return void
     */
    public function testSucessfulDelete()
    {
        $x = [
            'lat' => '19.048251',
            'lng' => '-98.190543',
            'name' => 'asdf',
            'address' => 'asdf',
            'user_id' => '1'
        ];
        $location =  Location::create($x);
        $locations = Location::all();
        $location = Location::find($location->id);
        $location->delete();
        $locations2 = Location::all();
        $this->assertNotEquals($locations, $locations2);
    }

    /**
     * Delete a location that doesn´t exists
     *
     * @return void
     */
    public function testUnsucessfulDelete()
    {
        $locations = Location::all();
        $location = Location::find(0);
        if ($location != null)
            $location->delete();
        $locations2 = Location::all();
        $this->assertEquals($locations, $locations2);
    }
}

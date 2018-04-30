<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Location;

class DeleteLocationTest extends TestCase
{
    /**
     * Delete a location that exists
     *
     * @return void
     */
    public function testSucessfulDelete()
    {
        $locations = Location::all();
        $location = Location::find(1);
        $location->delete();
        $locations2 = Location::all();
        $this->assertNotEqual($locations, $locations2);
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
        $this->assertEqual($locations, $locations2);
    }
}

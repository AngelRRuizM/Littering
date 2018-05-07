<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Location;

class UpdateLocationTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * The name of the location is empty
     *
     * @return void
     */
    public function testEmptyLocation()
    {
        $this->assertTrue(Location::validate([
            'lat' => '19.048251',
            'lng' => '-98.190543',
            'name' => '',
            'address' => 'asdfg',
            'user_id' => '1'
        ])->fails());
    }

    /**
     * The name of the location is only a char
     *
     * @return void
     */
    public function testOneCharLocation()
    {
        $this->assertFalse(Location::validate([
            'lat' => '19.048251',
            'lng' => '-98.190543',
            'name' => 'a',
            'address' => 'asdfg',
            'user_id' => '1'
        ])->fails());
    }

    /**
     * The name of the location has 50 chars
     *
     * @return void
     */
    public function testFiftyCharsLocation()
    {
        $this->assertFalse(Location::validate([
            'lat' => '19.048251',
            'lng' => '-98.190543',
            'name' => 'gktcbkplygtiolnbvftogpuhgytrdfghjklptyblghjlmnbgyu',
            'address' => 'asdfg',
            'user_id' => '1'
        ])->fails());
    }

    /**
     * The name of the location has 51 chars
     *
     * @return void
     */
    public function testFiftyOneCharsLocation()
    {
        $this->assertTrue(Location::validate([
            'lat' => '19.048251',
            'lng' => '-98.190543',
            'name' => 'gktcbkplygtiolnbvftogpuhgytrdfghjklptyblghjlmnbgyuw',
            'address' => 'asdfg',
            'user_id' => '1'
        ])->fails());
    }

    /**
     * The address of the location is empty
     *
     * @return void
     */
    public function testEmptyAddress()
    {
        $this->assertTrue(Location::validate([
            'lat' => '19.048251',
            'lng' => '-98.190543',
            'name' => 'gktc',
            'address' => '',
            'user_id' => '1'
        ])->fails());
    }

    /**
     * The address of the location is only a char
     *
     * @return void
     */
    public function testOneCharAddress()
    {
        $this->assertFalse(Location::validate([
            'lat' => '19.048251',
            'lng' => '-98.190543',
            'name' => 'gktc',
            'address' => 'a',
            'user_id' => '1'
        ])->fails());
    }

    /**
     * The address of the location has 50 chars
     *
     * @return void
     */
    public function testHundredAndFiftyCharAddress()
    {
        $this->assertFalse(Location::validate([
            'lat' => '19.048251',
            'lng' => '-98.190543',
            'name' => 'gktc',
            'address' => 'gktcbkplygtiolnbvftogpuhgytrdfghjklptyblghjlmnbgyugktcbkplygtiolnbvftogpuhgytrdfghjklptyblghjlmnbgyugktcbkplygtiolnbvftogpuhgytrdfghjklptyblghjlmnbgyu',
            'user_id' => '1'
        ])->fails());
    }

    /**
     * The name of the location has 151 chars
     *
     * @return void
     */
    public function testHundredAndFiftyOneCharAddress()
    {
        $this->assertTrue(Location::validate([
            'lat' => '19.048251',
            'lng' => '-98.190543',
            'name' => 'gktc',
            'address' => 'gktcbkplygtiolnbvftogpuhgytrdfghjklptyblghjlmnbgyugktcbkplygtiolnbvftogpuhgytrdfghjklptyblghjlmnbgyugktcbkplygtiolnbvftogpuhgytrdfghjklptyblghjlmnbgyuw',
            'user_id' => '1'
        ])->fails());
    }

    /**
     * Send a null name
     *
     * @return void
     */
    public function testNullName()
    {
        $this->assertTrue(Location::validate([
            'lat' => '19.048251',
            'lng' => '-98.190543',
            'name' => null,
            'address' => 'asdg',
            'user_id' => '1'
        ])->fails());
    }

    /**
     * Send a null address
     *
     * @return void
     */
    public function testNullAddress()
    {
        $this->assertTrue(Location::validate([
            'lat' => '19.048251',
            'lng' => '-98.190543',
            'name' => 'asfg',
            'address' => null,
            'user_id' => '1'
        ])->fails());
    }

    /**
     * Send a user_id of a user that exists
     *
     * @return void
     */
    public function testExistantUser()
    {
        $this->assertFalse(Location::validate([
            'lat' => '19.048251',
            'lng' => '-98.190543',
            'name' => 'asfg',
            'address' => 'asdf',
            'user_id' => '1'
        ])->fails());
    }

     /**
     * Send a user_id of a user that doesn't exists
     *
     * @return void
     */
    public function testUnexistantUser()
    {
        $this->assertTrue(Location::validate([
            'lat' => '19.048251',
            'lng' => '-98.190543',
            'name' => 'asfg',
            'address' => 'asdf',
            'user_id' => '0'
        ])->fails());
    }

     /**
     * Create a new valid location and retrieve it
     *
     * @return void
     */
    public function testValidLocation()
    {

        $x = [
            'lat' => '19.048251',
            'lng' => '-98.190543',
            'name' => 'asfg',
            'address' => 'asdf',
            'user_id' => '1'
        ];
        $locationP = Location::create($x);
        $location = Location::find($locationP->id);
        $x = [
            'lat' => '19.048251',
            'lng' => '-98.190543',
            'name' => 'lololol',
            'address' => 'asdf',
            'user_id' => '1'
        ];
        if (!Location::validate($x)->fails()){
            $location->lat = $x['lat'];
            $location->lng = $x['lng'];
            $location->name = $x['name'];
            $location->address = $x['address'];
            $location->user_id = $x['user_id'];
            $location->save();
        }
        $location = Location::find($locationP->id);
        $this->assertNotEquals($locationP, $location);
    }

    /**
     * Create a new invalid location and retrieve it
     *
     * @return void
     */
    public function testInvalidLocation()
    {

        $x = [
            'lat' => '19.048251',
            'lng' => '-98.190543',
            'name' => 'asfg',
            'address' => 'asdf',
            'user_id' => '1'
        ];
        $locationP = Location::create($x);
        $location = Location::find($locationP->id);
        $x = [
            'lat' => '19.048251',
            'lng' => '-98.190543',
            'name' => 'asfg',
            'address' => 'asdf',
            'user_id' => '0'
        ];
        if (!Location::validate($x)->fails()){
            $location->lat = $x['lat'];
            $location->lng = $x['lng'];
            $location->name = $x['name'];
            $location->address = $x['address'];
            $location->user_id = $x['user_id'];
            $location->save();
        }
        $locationC = Location::find($locationP->id);
        $this->assertEquals($locationP->lat, $locationC->lat);
        $this->assertEquals($locationP->lng, $locationC->lng);
        $this->assertEquals($locationP->name, $locationC->name);
        $this->assertEquals($locationP->address, $locationC->address);
    }
}

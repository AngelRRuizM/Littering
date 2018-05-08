<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Pin;
use App\User;

class SetPinsAsCollectedTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * The pin does not exists
     *
     * @return void
     */
    public function testUnexistentPin()
    {

        $pin = Pin::find(0);
        $this->assertEquals($pin, null);
    }

    /**
     * The pin is marked succesfully
     *
     * @return void
     */
    public function testInvalidUser()
    {
        $pin = Pin::find(1);
        $this->assertNotEquals($pin, null);
        $pin->collected = true;
        $pin->save();
        $pin = Pin::find(1);
        $this->assertTrue($pin->collected == true);
    }


}

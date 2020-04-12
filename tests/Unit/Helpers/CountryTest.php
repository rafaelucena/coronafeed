<?php

namespace Tests\Unit\Helpers;

use App\Helpers\Country;
use Tests\TestCase;

class CountryTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function testCountryCodeByNameIsValid()
    {
        $countries = new Country();
        $this->assertEquals('br', $countries->getIsoByName('brazil'));
        $this->assertEquals('br', $countries->getIsoByName('Brazil'));
        $this->assertEquals('br', $countries->getIsoByName('BRAZIL'));
        $this->assertEquals('br', $countries->getIsoByName('BrAzIl'));
    }

    /**
     * @test
     *
     * @return void
     */
    public function testCountryCodeByNameIsInvalid()
    {
        $countries = new Country();
        $this->assertNotEquals('br', $countries->getIsoByName('bruh'));
        $this->assertNotEquals('br', $countries->getIsoByName('bearn'));
        $this->assertNotEquals('br', $countries->getIsoByName('brzila'));
    }

    /**
     * @test
     *
     * @return void
     */
    public function testCountryCodeByWorldometerIsValid()
    {
        $countries = new Country();
        $this->assertEquals('us', $countries->getIsoByWorldometerName('usa'));
        $this->assertEquals('us', $countries->getIsoByWorldometerName('USA'));
        $this->assertEquals('us', $countries->getIsoByWorldometerName('UsA'));
    }

    /**
     * @test
     *
     * @return void
     */
    public function testCountryCodeByWorldometerIsInvalid()
    {
        $countries = new Country();
        $this->assertNotEquals('us', $countries->getIsoByWorldometerName('usada'));
        $this->assertNotEquals('us', $countries->getIsoByWorldometerName('ussa'));
        $this->assertNotEquals('us', $countries->getIsoByWorldometerName('asu'));
    }
}
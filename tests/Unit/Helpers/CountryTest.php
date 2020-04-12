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
}
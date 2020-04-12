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
        $this->assertEquals('br', $countries->getCountryCodeByName('brazil'));
        $this->assertEquals('br', $countries->getCountryCodeByName('Brazil'));
        $this->assertEquals('br', $countries->getCountryCodeByName('BRAZIL'));
        $this->assertEquals('br', $countries->getCountryCodeByName('BrAzIl'));
    }
}
<?php

namespace Tests\Console\Services;

use App\Console\Services\ScrapeWorldOMetersService;
use Tests\TestCase;

class ScrapeWorldTest extends TestCase
{
    /** @var ScrapeWorldOMetersService */
    private $service;

    /**
     * Function to replace setUp
     *
     * @return void
     */
    public function runMeFirst()
    {
        $this->service = new ScrapeWorldOMetersService();
        $this->service->setIsTest(true);
        $this->service->rock();
    }

    /**
     * @test
     *
     * @return void
     */
    public function testIsFlagTestSet()
    {
        $this->runMeFirst();

        $this->assertEquals(true, $this->service->getIsTest());
    }

    /**
     * @test
     *
     * @return void
     */
    public function testCountIsCorrectAndKeysExist()
    {
        $this->runMeFirst();

        $this->assertCount(221, $this->service->getLocationsList());
        $this->assertArrayHasKey('World', array_flip($this->service->getLocationsList()));
        $this->assertArrayHasKey('Brazil', array_flip($this->service->getLocationsList()));
        $this->assertArrayHasKey('USA', array_flip($this->service->getLocationsList()));
    }

    public function testIsWorldArrayCorrect()
    {
        $this->runMeFirst();

        $world = $this->service->getMappedLocation('World');
        $this->assertArrayHasKey('yesterday', $world);
        $this->assertArrayHasKey('today', $world);
        $this->assertArrayHasKey('total_cases', $world['today']);
        $this->assertEquals(1727038, $world['today']['total_cases']);
    }
}
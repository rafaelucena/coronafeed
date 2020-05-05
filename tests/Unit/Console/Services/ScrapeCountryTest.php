<?php

namespace Tests\Console\Services;

use App\Console\Services\Worldometer\ScrapeCountryService;
use Tests\TestCase;

class ScrapeCountryTest extends TestCase
{
    /** @var ScrapeCountryService */
    private $service;

    /**
     * Function to replace setUp
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();
        $this->service = new ScrapeCountryService();
        // $this->service->setIsTest(true);
        $this->service->rock('kr', 's. korea');
    }

    /**
     * @test
     *
     * @return void
     */
    public function testIsFlagTestSet()
    {
        // $this->runMeFirst();
        // $this->assertTrue(true);
        // $this->assertEquals(true, $this->service->getIsTest());
    // }

    // public function testDataIsAllHere()
    // {
        $this->assertEquals([], last($this->service->getMappedCharts()));
        // $this->service->roll()
    }
}
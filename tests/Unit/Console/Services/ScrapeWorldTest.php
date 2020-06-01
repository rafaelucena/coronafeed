<?php

namespace Tests\Console\Services;

use App\Console\Services\Worldometer\ScrapeWorldService;
use Tests\TestCase;

class ScrapeWorldTest extends TestCase
{
    /** @var ScrapeWorldService */
    protected $service;

    /**
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->service = new ScrapeWorldService();
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
        $this->assertEquals(true, $this->service->getIsTest());
    }

    public function testIsLocationParsed()
    {
        $content = '<tr style="">
        <td style="font-size:12px;color: grey;text-align:center;vertical-align:middle;">2</td>
        <td style="font-weight: bold; font-size:15px; text-align:left;"><a class="mt_a" href="country/us/">USA</a></td>
        <td style="font-weight: bold; text-align:right">1,837,170</td>
        <td style="font-weight: bold; text-align:right;background-color:#FFEEAA;">+20,350</td>
        <td style="font-weight: bold; text-align:right;">106,195 </td>
        <td style="font-weight: bold; text-align:right;background-color:red; color:white">+638</td>
        <td style="font-weight: bold; text-align:right">599,867</td>
        <td style="text-align:right;font-weight:bold;">1,131,108</td>
        <td style="font-weight: bold; text-align:right">17,075</td>
        <td style="font-weight: bold; text-align:right">5,553</td>
        <td style="font-weight: bold; text-align:right">321</td>
        <td style="font-weight: bold; text-align:right">17,672,567</td>
        <td style="font-weight: bold; text-align:right">53,417</td>
        <td style="font-weight: bold; text-align:right"><a href="/world-population/us-population/">330,843,477</a> </td>
        <td style="display:none" data-continent="North America">North America</td>
        </tr>';
        $parsed = $this->callPrivate('getContentArray', $content);

        $this->assertEquals('USA', $parsed['country']);
    }

    /**
     * @test
     *
     * @return void
     */
    public function testCountIsCorrectAndKeysExist()
    {
        $this->assertCount(224, $this->service->getLocationsList());
        $this->assertArrayHasKey('World', array_flip($this->service->getLocationsList()));
        $this->assertArrayHasKey('Brazil', array_flip($this->service->getLocationsList()));
        $this->assertArrayHasKey('USA', array_flip($this->service->getLocationsList()));
    }

    public function testIsWorldArrayCorrect()
    {
        $world = $this->service->getMappedLocation('World');
        $this->assertArrayHasKey('yesterday', $world);
        $this->assertArrayHasKey('today', $world);
        $this->assertArrayHasKey('total_cases', $world['today']);
        $this->assertEquals(6266888, $world['today']['total_cases']);
    }
}
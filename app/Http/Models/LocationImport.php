<?php

namespace App\Http\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="location_import")
 * @ORM\HasLifecycleCallbacks()
 */
class LocationImport
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2, nullable=false)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=127, nullable=false)
     */
    private $country;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $totalCases;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $newCases;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $totalDeaths;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $newDeaths;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $totalRecovered;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $activeCases;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $seriousCritical;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $casesByPopulation;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $deathsByPopulation;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $totalTests;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $testsByPopulation;

    /**
     * @ORM\Column(type="string", length=127, nullable=false)
     */
    private $continent;

    /**
     * @deprecated (type="string", columnDefinition="ENUM('today', 'yesterday')", nullable=false)
     * @ORM\Column(type="string", length=15, nullable=false)
     */
    private $type;

    /**
     * @ORM\Column(type="datetime", nullable=false, options={"default": "CURRENT_TIMESTAMP"})
     */
    private $created;

    public function setCode(string $code)
    {
        $this->code = $code;
    }

    public function setCountry(string $country)
    {
        $this->country = $country;
    }

    public function setTotalCases(int $totalCases)
    {
        $this->totalCases = $totalCases;
    }

    public function getTotalCases()
    {
        return $this->totalCases;
    }

    public function setNewCases(int $newCases)
    {
        $this->newCases = $newCases;
    }

    public function getNewCases()
    {
        return $this->newCases;
    }

    public function setTotalDeaths(int $totalDeaths)
    {
        $this->totalDeaths = $totalDeaths;
    }

    public function getTotalDeaths()
    {
        return $this->totalDeaths;
    }

    public function setNewDeaths(int $newDeaths)
    {
        $this->newDeaths = $newDeaths;
    }

    public function setTotalRecovered(int $totalRecovered)
    {
        $this->totalRecovered = $totalRecovered;
    }

    public function getTotalRecovered()
    {
        return $this->totalRecovered;
    }

    public function setActiveCases(int $activeCases)
    {
        $this->activeCases = $activeCases;
    }

    public function setSeriousCritical(int $seriousCritical)
    {
        $this->seriousCritical = $seriousCritical;
    }

    public function setCasesByPopulation(float $casesByPopulation)
    {
        $this->casesByPopulation = $casesByPopulation;
    }

    public function setDeathsByPopulation(float $deathsByPopulation)
    {
        $this->deathsByPopulation = $deathsByPopulation;
    }

    public function setTotalTests(int $totalTests)
    {
        $this->totalTests = $totalTests;
    }

    public function setTestsByPopulation(float $testsByPopulation)
    {
        $this->testsByPopulation = $testsByPopulation;
    }

    public function setContinent(string $continent)
    {
        $this->continent = $continent;
    }

    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @ORM\PrePersist()
     */
    public function onPrePersist()
    {
        $this->created = new \DateTime();
    }
}

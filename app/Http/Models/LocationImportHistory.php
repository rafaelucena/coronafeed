<?php

namespace App\Http\Models;

use App\Http\Models\Traits\IdTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="location_import_history")
 * @ORM\HasLifecycleCallbacks()
 */
class LocationImportHistory
{
    use IdTrait;

    /**
     * @ORM\Column(type="string", length=2, nullable=false)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=127, nullable=false)
     */
    private $country;

    /**
     * @ORM\Column(type="datetime", nullable=false, options={"default": "CURRENT_TIMESTAMP"})
     */
    private $date;

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

    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
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

    /**
     * @ORM\PrePersist()
     */
    public function onPrePersist()
    {
        $this->created = new \DateTime();
    }
}

<?php

namespace App\Http\Models;

use App\Http\Models\Traits\IdTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Event\PreUpdateEventArgs;

/**
 * @ORM\Entity()
 * @ORM\Table(name="location_history")
 * @ORM\HasLifecycleCallbacks()
 */
class LocationHistory
{
    use IdTrait;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $confirmed;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $deaths;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cured;

    /**
     * @ORM\Column(type="datetime", nullable=false, options={"default": "CURRENT_TIMESTAMP"})
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Location", inversedBy="locationHistory")
     * @ORM\JoinColumn(name="locations_id", referencedColumnName="id")
     */
    private $location;

    /**
     * @param Location $location
     * @return void
     */
    public function setLocation(Location $location): void
    {
        $this->location = $location;
    }

    /**
     * @return int
     */
    public function getConfirmed(): int
    {
        return $this->confirmed;
    }

    /**
     * @param integer $confirmed
     * @return void
     */
    public function setConfirmed(int $confirmed): void
    {
        $this->confirmed = $confirmed;
    }

    /**
     * @return int
     */
    public function getDeaths(): int
    {
        return $this->deaths;
    }

    /**
     * @param integer $deaths
     * @return void
     */
    public function setDeaths(int $deaths): void
    {
        $this->deaths = $deaths;
    }

    /**
     * @return int
     */
    public function getCured(): int
    {
        return $this->cured;
    }

    /**
     * @param integer $cured
     * @return void
     */
    public function setCured(int $cured): void
    {
        $this->cured = $cured;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return void
     */
    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }
}

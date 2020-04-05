<?php

namespace App\Http\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="location_numbers")
 * @ORM\HasLifecycleCallbacks()
 */
class LocationNumbers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $newCases;

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
    public $updated;

    /**
     * @ORM\OneToOne(targetEntity="Location", inversedBy="locationNumbers")
     * @ORM\JoinColumn(name="locations_id", referencedColumnName="id")
     */
    private $location;

    /**
     * @return int
     */
    public function getNewCases(): int
    {
        return $this->newCases;
    }

    /**
     * @param integer $newCases
     * @return void
     */
    public function setNewCases(int $newCases): void
    {
        $this->newCases = $newCases;
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
    public function getUpdated(): \DateTime
    {
        return $this->updated;
    }

    /**
     * @ORM\PreUpdate()
     */
    public function onPreUpdate()
    {
        $this->updated = new \DateTime();
    }
}

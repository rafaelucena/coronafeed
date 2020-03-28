<?php

namespace App\Http\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Event\PreUpdateEventArgs;

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
    private $suspected;

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
    public function getSuspected(): int
    {
        return $this->suspected;
    }

    /**
     * @return int
     */
    public function getConfirmed(): int
    {
        return $this->confirmed;
    }

    /**
     * @return int
     */
    public function getDeaths(): int
    {
        return $this->deaths;
    }

    /**
     * @return int
     */
    public function getCured(): int
    {
        return $this->cured;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated(): \DateTime
    {
        return $this->updated;
    }
}

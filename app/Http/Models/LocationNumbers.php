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
    public $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */    
    public $suspected;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */    
    public $confirmed;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */    
    public $deaths;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */    
    public $cured;

    /**
     * @ORM\OneToOne(targetEntity="Location", inversedBy="locationNumbers")
     * @ORM\JoinColumn(name="locations_id", referencedColumnName="id")
     */
    private $location;

    public function getSuspected()
    {
        return $this->suspected;
    }

    public function getConfirmed()
    {
        return $this->confirmed;
    }

    public function getDeaths()
    {
        return $this->deaths;
    }

    public function getCured()
    {
        return $this->cured;
    }
}

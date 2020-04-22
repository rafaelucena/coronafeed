<?php

namespace App\Http\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Event\PreUpdateEventArgs;

/**
 * @ORM\Entity()
 * @ORM\Table(name="location_type")
 * @ORM\HasLifecycleCallbacks()
 */
class LocationType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=127, nullable=false)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=127, nullable=false)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Location", mappedBy="locationType")
     */
    private $locations;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}

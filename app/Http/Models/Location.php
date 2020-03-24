<?php

namespace App\Http\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use LaravelDoctrine\ORM\Contracts\UrlRoutable;

/**
 * @ORM\Entity()
 * @ORM\Table(name="locations")
 * @ORM\HasLifecycleCallbacks()
 */
class Location implements UrlRoutable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */    
    private $name;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"})
     */
    private $isQuarantined;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"})
     */
    private $isContained;

    /**
     * @ORM\ManyToOne(targetEntity="LocationType", inversedBy="locations")
     * @ORM\JoinColumn(name="location_type_id", referencedColumnName="id")
     */
    private $locationType;

    /**
     * @ORM\OneToOne(targetEntity="LocationNumbers", mappedBy="location")
     */
    private $locationNumbers;

    /**
     * @ORM\OneToMany(targetEntity="Location", mappedBy="parent")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="Location", inversedBy="children")
     */
    private $parent;

    /**
     * @return string
     */
    public static function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return LocationNumbers
     */
    public function getLocationNumbers(): LocationNumbers
    {
        return $this->locationNumbers;
    }

    /**
     * @return LocationType
     */
    public function getLocationType(): LocationType
    {
        return $this->locationType;
    }

    /**
     * @return Location
     */
    public function getParent(): Location
    {
        return $this->parent;
    }

    /**
     * @return Location
     */
    public function getChildren()
    {
        return $this->children;
    }
}

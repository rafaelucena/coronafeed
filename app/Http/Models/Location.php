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
    public $id;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    public $locationTypeId;

    /**
     * @ORM\Column(type="string", length=255, nullable=false, unique=true)
     */
    public $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */    
    public $name;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"})
     */
    public $isQuarantined;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"})
     */
    public $isContained;

    /**
     * @ORM\OneToOne(targetEntity="LocationNumbers", mappedBy="location")
     */
    private $locationNumbers;

    /**
     *
     * @return string
     */
    public static function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLocationNumbers()
    {
        return $this->locationNumbers;
    }
}

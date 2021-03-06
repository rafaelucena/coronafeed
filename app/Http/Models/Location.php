<?php

namespace App\Http\Models;

use App\Http\Models\Traits\IdTrait;
use App\Http\Models\Traits\SlugTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\PersistentCollection;
use Illuminate\Support\Str;
use LaravelDoctrine\ORM\Contracts\UrlRoutable;

/**
 * @ORM\Entity()
 * @ORM\Table(name="locations")
 * @ORM\HasLifecycleCallbacks()
 */
class Location implements UrlRoutable
{
    use IdTrait;
    use SlugTrait;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $code;

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
     * @ORM\ManyToOne(targetEntity="LocationPriority", inversedBy="locations")
     * @ORM\JoinColumn(name="location_priority_id", referencedColumnName="id")
     */
    private $locationPriority;

    /**
     * @ORM\OneToOne(targetEntity="LocationNumbers", mappedBy="location")
     */
    private $locationNumbers;

    /**
     * @ORM\OneToMany(targetEntity="LocationHistory", mappedBy="location")
     */
    private $locationHistory;

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
     * @ORM\OneToMany(targetEntity="LocationSlug", mappedBy="location")
     */
    private $locationSlugs;

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
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code ?? '';
    }

    /**
     * @param string $code
     * @return void
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return LocationNumbers
     */
    public function getLocationNumbers(): LocationNumbers
    {
        return $this->locationNumbers;
    }

    /**
     * @param integer $limit
     * @return Location[]|ArrayCollection
     */
    public function getLocationHistory(int $limit = 15): ArrayCollection
    {
        if ($limit === 0) {
            $limit = null;
        }
        $criteria = Criteria::create()
            ->orderBy(['date' => 'DESC'])
            ->setMaxResults($limit);

        return $this->locationHistory->matching($criteria);
    }

    /**
     * @return LocationType
     */
    public function getLocationType(): LocationType
    {
        return $this->locationType;
    }

    /**
     * @param LocationType $locationType
     * @return void
     */
    public function setLocationType(LocationType $locationType): void
    {
        $this->locationType = $locationType;
    }

    /**
     * @return Location
     */
    public function getParent(): Location
    {
        return $this->parent;
    }

    /**
     * @param Location $location
     * @return void
     */
    public function setParent(Location $location): void
    {
        $this->parent = $location;
    }

    /**
     * @return PersistentCollection
     */
    public function getChildren(): PersistentCollection
    {
        return $this->children;
    }

    /**
     * @ORM\PrePersist()
     */
    public function onPrePersist()
    {
        $this->slug = Str::slug($this->name);
        $this->isQuarantined = (int) false;
        $this->isContained = (int) false;
    }
}

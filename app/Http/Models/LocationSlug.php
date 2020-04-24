<?php

namespace App\Http\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use LaravelDoctrine\ORM\Contracts\UrlRoutable;

/**
 * @ORM\Entity()
 * @ORM\Table(name="location_slug")
 * @ORM\HasLifecycleCallbacks()
 */
class LocationSlug implements UrlRoutable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Language", inversedBy="locationSlugs")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     */
    private $language;

    /**
     * @ORM\ManyToOne(targetEntity="Location", inversedBy="locationSlugs")
     * @ORM\JoinColumn(name="location_id", referencedColumnName="id")
     */
    private $location;

    /**
     * @return string
     */
    public static function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * @param string $slug
     * @return void
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param Language $language
     * @return void
     */
    public function setLanguage(Language $language): void
    {
        $this->language = $language;
    }

    /**
     * @return Language
     */
    public function getLanguage(): Language
    {
        return $this->language;
    }

    /**
     * @param Location $location
     * @return void
     */
    public function setLocation(Location $location): void
    {
        $this->location = $location;
    }

    /**
     * @return Location
     */
    public function getLocation(): Location
    {
        return $this->location;
    }
}

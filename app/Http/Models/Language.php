<?php

namespace App\Http\Models;

use App\Http\Models\Traits\IdTrait;
use App\Http\Models\Traits\SlugTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\PersistentCollection;
use LaravelDoctrine\ORM\Contracts\UrlRoutable;

/**
 * @ORM\Entity()
 * @ORM\Table(name="languages")
 * @ORM\HasLifecycleCallbacks()
 */
class Language implements UrlRoutable
{
    use IdTrait;
    use SlugTrait;

    /**
     * @ORM\Column(type="string", length=5, nullable=false)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="LocationSlug", mappedBy="language")
     */
    private $locationSlugs;

    /**
     * @ORM\OneToMany(targetEntity="LocationLanguageView", mappedBy="language")
     */
    private $locationLanguageViews;

    /**
     * @return string
     */
    public static function getRouteKeyName(): string
    {
        return 'code';
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
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
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
     * @param array $parameters
     * @return PersistentCollection
     */
    public function getLocationLanguageViews(array $parameters = []): PersistentCollection
    {
        // $criteria = custom_criteria($parameters);
        // return $this->locationLanguageViews->matching($criteria);
        return $this->locationLanguageViews;
    }
}

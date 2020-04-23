<?php

namespace App\Http\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\ORM\Event\PreUpdateEventArgs;

/**
 * @ORM\Entity()
 * @ORM\Table(name="location_language_views")
 * @ORM\HasLifecycleCallbacks()
 */
class LocationLanguageView
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
    private $constant;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="Language", inversedBy="locationLanguageViews")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     */
    private $language;

    /**
     * @param string $constant
     * @return void
     */
    public function setConstant(string $constant): void
    {
        $this->constant = $constant;
    }

    /**
     * @return string
     */
    public function getConstant(): string
    {
        return $this->constant;
    }

    /**
     * @param string $value
     * @return void
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}

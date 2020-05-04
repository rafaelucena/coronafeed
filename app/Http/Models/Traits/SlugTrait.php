<?php

namespace App\Http\Models\Traits;

trait SlugTrait
{
    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $slug;

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
}

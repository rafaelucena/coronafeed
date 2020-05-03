<?php

namespace App\Http\Models\Traits;

trait IdTrait
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;

    /**
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }
}

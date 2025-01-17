<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Trait Active
 *
 * @package App\Entity\Traits
 */
trait Active
{
    #[ORM\Column(type: 'boolean', nullable: true)]
    #[Groups(['full', 'list'])]
    private ?bool $active = true;

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }
}
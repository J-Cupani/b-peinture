<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Trait PostalAddress
 *
 * @package App\Entity\Traits
 */
trait City
{
    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    #[Groups(['full'])]
    private ?string $city = null;

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
    }
}

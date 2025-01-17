<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Trait PostalAddress
 *
 * @package App\Entity\Traits
 */
trait PostalAddress
{
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['full'])]
    private ?string $postalAddress = null;

    public function getPostalAddress(): ?string
    {
        return $this->postalAddress;
    }

    public function setPostalAddress(?string $postalAddress): void
    {
        $this->postalAddress = $postalAddress;
    }
}

<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Trait PostalAddress
 *
 * @package App\Entity\Traits
 */
trait PostalCode
{
    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    #[Groups(['full'])]
    private ?string $postalCode = null;

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }
}

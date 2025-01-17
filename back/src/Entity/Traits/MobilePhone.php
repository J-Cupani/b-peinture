<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Trait PostalAddress
 *
 * @package App\Entity\Traits
 */
trait MobilePhone
{
    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    #[Groups(['full'])]
    private ?string $mobilePhone = null;

    public function getMobilePhone(): ?string
    {
        return $this->mobilePhone;
    }

    public function setMobilePhone(?string $mobilePhone): void
    {
        $this->mobilePhone = $mobilePhone;
    }
}

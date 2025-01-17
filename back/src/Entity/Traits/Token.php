<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Trait Token
 * @package App\Entity\Traits
 */
trait Token
{
    #[Groups(['full', 'list'])]
    #[ORM\Column(type: 'string', length: 15)]
    private ?string $token = null;

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }
}
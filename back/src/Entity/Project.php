<?php

namespace App\Entity;

use App\Entity\Traits\Active;
use App\Entity\Traits\Token;
use App\Enum\ProjectTag;
use App\Repository\ProjectRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project extends CommonEntity
{
    use Token, Active;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['full', 'list'])]
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[Groups(['full', 'list'])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true, enumType: ProjectTag::class)]
    private ?ProjectTag $tag = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['full', 'list'])]
    private ?string $imageName = null;

    public function __construct()
    {
        parent::__construct();
    }

    #[Groups(['full', 'list'])]
    public function getTagValue(): ?string
    {
        return $this->tag?->value;
    }

    #[Groups(['full', 'list'])]
    public function getTagLabel(): ?string
    {
        return $this->tag?->label();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getTag(): ?ProjectTag
    {
        return $this->tag;
    }

    public function setTag(?ProjectTag $tag): self
    {
        $this->tag = $tag;

        return $this;
    }


    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }
}



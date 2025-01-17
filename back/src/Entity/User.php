<?php

namespace App\Entity;

use App\Entity\Traits\Active;
use App\Entity\Traits\Token;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(
    fields: ['email'],
    message: "L'email que vous avez indiquez est déjà utilisé",
    entityClass: User::class
)]
class User extends CommonEntity implements UserInterface, PasswordAuthenticatedUserInterface
{
    use Token, Active;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[NotBlank(message: "Le champ email ne peut être vide")]
    #[Email(message: "Le champ email '{{ value }}' n'est pas valide")]
    #[Groups(['full', 'list'])]
    private ?string $email = null;

    #[ORM\Column(type: 'json')]
    #[Groups(['full'])]
    private array $roles = [];

    #[ORM\Column(type: 'string')]
    private string $password;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['full', 'list'])]
    private ?string $firstName = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['full', 'list'])]
    private ?string $lastName = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $dateCreation;

    #[ORM\Column(type: 'string', length: 25, nullable: true)]
    private ?string $resetPasswordToken;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $dateRequestResetPassword;

    #[ORM\Column(type: 'boolean')]
    private bool $needToResetPassword = true;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['full', 'list'])]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?bool $anonymous = false;

    public function __construct()
    {
        $this->dateCreation = new DateTime();
        $this->setActive(true);
        $this->setAnonymous(false);
        $this->setNeedToResetPassword(true);
        $this->setResetPasswordToken($this->generatePassword(25));
        $this->setDateRequestResetPassword(new DateTime());

        parent::__construct();
    }

    public function setAnonymous(?bool $anonymous): static
    {
        $this->anonymous = $anonymous;

        return $this;
    }

    public function generatePassword($car = 14): string
    {
        return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, $car);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // On ajoute les roles ROLE_ADMIN et + au role ROLE_SUPER_ADMIN
        if (in_array('ROLE_SUPER_ADMIN', $roles)) {
            $roles[] = 'ROLE_ADMIN';
        }
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    #[Groups(['full'])]
    public function isAdmin(): bool
    {
        return $this->getRole() === 'ROLE_SUPER_ADMIN';
    }

    #[Groups(['full'])]
    public function getRole(): string
    {
        return match (true) {
            in_array('ROLE_SUPER_ADMIN', $this->roles) => 'ROLE_SUPER_ADMIN',
            default => 'ROLE_USER'
        };

    }

    #[Groups(['full'])]
    public function getRoleLabel(): string
    {
        return match (true) {
            in_array('ROLE_SUPER_ADMIN', $this->roles) => 'Super Admin',

            default => 'Utilisateur'
        };
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    #[Groups(['full', 'list'])]
    public function getFullName(): ?string
    {
        return $this->lastName . ' ' . $this->firstName;
    }

    public function getInitial(): ?string
    {
        return substr($this->lastName, 0, 1) . substr($this->firstName, 0, 1);
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getResetPasswordToken(): ?string
    {
        return $this->resetPasswordToken;
    }

    public function setResetPasswordToken(?string $resetPasswordToken): self
    {
        $this->resetPasswordToken = $resetPasswordToken;

        return $this;
    }

    public function getDateRequestResetPassword(): ?\DateTimeInterface
    {
        return $this->dateRequestResetPassword;
    }

    public function setDateRequestResetPassword(\DateTimeInterface $dateRequestResetPassword): self
    {
        $this->dateRequestResetPassword = $dateRequestResetPassword;

        return $this;
    }

    public function getNeedToResetPassword(): ?bool
    {
        return $this->needToResetPassword;
    }

    public function setNeedToResetPassword(bool $needToResetPassword): self
    {
        $this->needToResetPassword = $needToResetPassword;

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

    public function isAnonymous(): ?bool
    {
        return $this->anonymous;
    }
}

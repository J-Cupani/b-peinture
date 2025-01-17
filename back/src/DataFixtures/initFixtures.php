<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class initFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher, protected Filesystem $filesystem)
    {
    }

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager,): void
    {
        $this->filesystem->remove(['public/uploads']);

        // Joachim
        $user = new User();
        $user->setEmail('joachim.cupani@c4dev.fr');

        $user->setPassword($this->passwordHasher->hashPassword(
            $user,
            'joachim.cupani@c4dev.fr'
        ));
        $user->setFirstName("Joachim");
        $user->setLastName("Cupani");
        $user->setRoles(["ROLE_SUPER_ADMIN"]);
        $user->setActive(true);
        $user->setToken("SUPERJOJO4");

        $manager->persist($user);

        $manager->flush();
    }
}

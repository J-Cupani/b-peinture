<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user): void
    {

        if (!$user instanceof User) {
            return;
        }

        if (!$user->getActive()) {
            // the message passed to this exception is meant to be displayed to the user
            throw new AccountExpiredException('Compte inactif Pre');
        }
    }

    public function checkPostAuth(UserInterface $user): void
    {
        if (!$user instanceof User) {
            return;
        }

        // user account is expired, the user may be notified
        if (!$user->getActive()) {
            throw new AccountExpiredException('Compte inactif Post');
        }
    }
}
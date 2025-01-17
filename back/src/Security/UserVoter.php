<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserVoter extends Voter
{
    const VIEW = 'view';
    const EDIT = 'edit';
    const ME = 'me';

    public function __construct(
        protected Security $security,
    ) {
    }

    protected function supports(string $attribute, mixed $subject): bool
    {
        if (!in_array($attribute, [self::VIEW, self::EDIT, self::ME])) {
            return false;
        }

        if (!$subject instanceof User) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        if (!$user instanceof User || !$user->isActive()) {
            return false;
        }

        return match ($attribute) {
            self::ME => $this->isMe($subject, $user),
            self::VIEW => $this->canViewUser($subject, $user),
            self::EDIT => $this->canEditUser($subject, $user),
            default => throw new \LogicException('Ce code ne devrait pas être atteint!'),
        };
    }

    private function isMe(User $user, User $me): bool
    {
        return $user === $me;
    }

    private function canViewUser(User $user, User $me): bool
    {
        return $this->canEditUser($user, $me);
    }

    private function canEditUser(User $user, User $me): bool
    {
        if ($user->getToken() === $me->getToken()) {
            return true;
        }

        if ($this->security->isGranted('ROLE_SUPER_ADMIN') && $me->isActive()) {
            return true;
        }

        return false;
    }
}

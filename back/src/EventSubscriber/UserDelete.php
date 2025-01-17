<?php

namespace App\EventSubscriber;

use App\Entity\User;
use App\Service\FileUploaderService;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PreRemoveEventArgs;
use Doctrine\ORM\Events;

#[AsDoctrineListener(event: Events::preRemove, priority: 500, connection: 'default')]
class UserDelete
{
    public function __construct(protected FileUploaderService $fileUploader)
    {

    }


    public function preRemove(PreRemoveEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof User) {
            return;
        }

        if ($entity->getImageName() !== '' and $entity->getImageName() !== null) {
            $this->fileUploader->delete('avatars/' . $entity->getImageName());
        }

    }


}
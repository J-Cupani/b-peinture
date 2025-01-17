<?php

namespace App\EventSubscriber;

use App\Entity\User;
use App\Service\FileUploaderService;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;

#[AsDoctrineListener(event: Events::preUpdate, priority: 500, connection: 'default')]
class UserAnonymous
{
    public function __construct(protected FileUploaderService $fileUploader)
    {

    }


    public function preUpdate(PreUpdateEventArgs $args): void
    {
        $entity = $args->getObject();


        if (!$entity instanceof User) {
            return;
        }

        // L'entité a été modifiée, vous pouvez vérifier la modification de l'attribut `active`
        if ($args->hasChangedField('anonymous')) {
            $oldAnonymousValue = $args->getOldValue('anonymous');
            $newAnonymousValue = $args->getNewValue('anonymous');

            // on vient d'activer le compte
            if (!$oldAnonymousValue and $newAnonymousValue) {
                if ($entity->getImageName() !== '' and $entity->getImageName() !== null) {
                    $this->fileUploader->delete('avatars/' . $entity->getImageName());
                }
            }
        }
    }

}
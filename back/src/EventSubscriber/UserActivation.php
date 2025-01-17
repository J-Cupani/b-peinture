<?php

namespace App\EventSubscriber;

use App\Entity\User;
use App\Service\MailService;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

#[AsDoctrineListener(event: Events::preUpdate, priority: 500, connection: 'default')]
#[AsDoctrineListener(event: Events::prePersist, priority: 500, connection: 'default')]
class UserActivation
{
    public function __construct(protected MailService $messageService)
    {

    }


    /**
     * @throws TransportExceptionInterface
     */
    public function preUpdate(PreUpdateEventArgs $args): void
    {
        $entity = $args->getObject();


        if (!$entity instanceof User) {
            return;
        }

        // L'entité a été modifiée, vous pouvez vérifier la modification de l'attribut `active`
        if ($args->hasChangedField('active')) {
            $oldActiveValue = $args->getOldValue('active');
            $newActiveValue = $args->getNewValue('active');

            // on vient d'activer le compte
            if (!$oldActiveValue and $newActiveValue) {
                $this->messageService->activationEmail($entity);
            }
        }
    }


    /**
     * @throws TransportExceptionInterface
     */
    public function prePersist(PrePersistEventArgs $args): void
    {
        $entity = $args->getObject();


        if (!$entity instanceof User) {
            return;
        }
        if ($entity->getActive()) {
            $this->messageService->activationEmail($entity);
        }
    }


}
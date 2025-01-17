<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class DebugSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }

    public function onKernelResponse(ResponseEvent $event)
    {
        // Si on est en mode développement
        if ($_ENV['APP_ENV'] !== 'dev') {
            return;
        }

        $response = $event->getResponse();

        // Ajouter un en-tête avec des informations de débogage
        $debugData = ['debug' => 'Informations de debug'];
        $response->headers->set('X-Debug-Info', json_encode($debugData));
    }
}
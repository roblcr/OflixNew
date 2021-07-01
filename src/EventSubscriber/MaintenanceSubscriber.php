<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class MaintenanceSubscriber implements EventSubscriberInterface
{
    public function onKernelResponse(ResponseEvent $event)
    {
        $response = $event->getResponse();
        // dump($response);
        $content = $response->getContent();

       

        $MaintenanceMsg = $_ENV['MAINTENANCE_MSG'];

        if (!empty($MaintenanceMsg)){
            $content = str_replace('<body>', '<body><div class="mb-0 text-center alert alert-danger">' . $MaintenanceMsg . '</div>', $content);
                        // dump($content);
                        $response->setContent($content);


        }

        
        
         
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.response' => 'onKernelResponse',
        ];
    }
}

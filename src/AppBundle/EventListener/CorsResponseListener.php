<?php

namespace AppBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class CorsResponseListener
{
    public function onKernelResponse(FilterResponseEvent $event)
    {
        $headers = $event->getResponse()->headers;
        $headers->set('Access-Control-Allow-Origin', '*');
    }
}

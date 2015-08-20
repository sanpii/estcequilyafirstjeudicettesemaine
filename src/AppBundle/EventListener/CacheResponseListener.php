<?php

namespace AppBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class CacheResponseListener
{
    public function onKernelResponse(FilterResponseEvent $event)
    {
        $controller = $event->getRequest()->attributes->get('_controller');
        $controller = explode(':', $controller)[0];

        $now = new \DateTime();
        switch ($controller) {
            case 'front_controller':
                $interval = new \DateInterval('P1Y');
                $expires = $now->add($interval);
            break;
            case 'api_controller':
                $interval = new \DateInterval('P1D');
                $expires = $now->add($interval);
                $expires->setTime(0, 0);
            break;
            default:
                return;
        }

        $headers = $event->getResponse()->headers;
        $headers->set('Expires', $expires->format('r'));
        $headers->set('Cache-Control', 'public, must-revalidate');
    }
}

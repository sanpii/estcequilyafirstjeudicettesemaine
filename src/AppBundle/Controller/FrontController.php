<?php

namespace AppBundle\Controller;

use \Symfony\Component\HttpFoundation\Response;
use \Symfony\Component\Templating\EngineInterface;

class FrontController
{
    private $templating;

    public function __construct(EngineInterface $templating)
    {
        $this->templating = $templating;
    }

    public function indexAction()
    {
        return new Response(
            $this->templating->render(
                'AppBundle:Front:index.html.twig'
            )
        );
    }
}

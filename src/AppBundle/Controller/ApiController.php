<?php

namespace AppBundle\Controller;

use \AppBundle\Service\FirstJeudi;
use \Symfony\Component\HttpFoundation\Response;

class ApiController
{
    private $firstJeudi;

    public function __construct(FirstJeudi $firstJeudi)
    {
        $this->firstJeudi = $firstJeudi;
    }

    public function indexAction()
    {
        return new Response(
            json_encode($this->firstJeudi->toArray()),
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}

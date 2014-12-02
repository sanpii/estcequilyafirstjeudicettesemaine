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

    public function optionsIndexAction()
    {
        return new Response(
            '',
            Response::HTTP_NO_CONTENT,
            [
                'Access-Control-Allow-Headers' => 'Content-Type',
                'Access-Control-Allow-Methods' => 'GET',
            ]
        );
    }

    public function getIndexAction()
    {
        return new Response(
            json_encode($this->firstJeudi->toArray()),
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}

<?php
declare(strict_types = 1);

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

    public function optionsIndexAction(): Response
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

    public function getIndexAction(): Response
    {
        return new Response(
            json_encode($this->firstJeudi->toArray()),
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}

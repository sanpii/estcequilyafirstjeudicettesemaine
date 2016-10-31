<?php

use \Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . '/../app/autoload.php';

$kernel = new AppKernel();

$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
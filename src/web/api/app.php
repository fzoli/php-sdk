<?php

require_once __DIR__.'/../../bootstrap.php';

use App\Api\ApiKernel;
use Symfony\Component\HttpFoundation\Request;

$kernel = new ApiKernel();
Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);

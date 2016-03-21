<?php
use Symfony\Component\HttpFoundation\Request;

require __DIR__.'/../app/AppKernel.php';

//$kernel = new AppKernel('prod', true);
$kernel = new AppKernel('dev', true); // To activate debug tools
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
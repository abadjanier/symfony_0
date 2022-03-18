<?php

use App\Backend\BackendKernel;
//use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;

$loader = require __DIR__.'/../../../vendor/autoload.php';
$dotenv = new Dotenv();
$dotenv->load(dirname(__DIR__).'/../../.env');
// auto-load annotations
//AnnotationRegistry::registerLoader([$loader, 'loadClass']);
$kernel = new BackendKernel($_ENV['APP_ENV'], $_ENV['APP_ENV']=='dev');
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
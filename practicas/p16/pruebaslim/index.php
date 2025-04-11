<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
require 'vendor/autoload.php';

$app = AppFactory::create();
$app->setBasepath("/tecweb/practicas/p16/pruebaslim");

$app->get('/', function ($request, $response, $args){
    $response->getBody()->write("Hola mundo Slim");
    return $response;
});
$app->run();
?>
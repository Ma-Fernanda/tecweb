<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use TECWEB\Create\Create;
use TECWEB\Read\Read;
use TECWEB\Update\Update;
use TECWEB\Delete\Delete as Delete;

require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/myapi/DataBase.php';
require_once __DIR__ . '/myapi/Create/Create.php';
require_once __DIR__ . '/myapi/Read/Read.php';
require_once __DIR__ . '/myapi/Update/Update.php';
require_once __DIR__ . '/myapi/Delete/Delete.php';

$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);
$app->setBasePath('/tecweb/actividades/a09/product_app/backend');



$app->post('/product', function ($request, $response, $args){
    $prodObj = new Create('marketzone');
    $input = $request->getBody()->getContents();
    $data = json_decode($input, true); 
    $Producto = (object)$data;
    $prodObj->add($Producto);
    $response->getBody()->write(json_encode($prodObj->getData()));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->put('/product/{id}', function (Request $request,Response $response, $args){
    $prodObj = new Update('marketzone');
    $input = $request->getBody()->getContents();
    $data = json_decode($input, true);
    $Producto = (object)$data;
    $prodObj->edit($Producto); 
    $response->getBody()->write($prodObj->getData());
    return $response->withHeader('Content-Type', 'application/json');
});


$app->delete('/product/{id}', function ($request, $response, $args){
    $prodObj = new Delete('marketzone');
    $id = $args['id'];
    $prodObj->delete($id);
    $response->getBody()->write($prodObj->getData());
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/products/{search}', function ($request, $response, $args){    
    $prodObj = new Read('marketzone');
    $search = $args['search'] ?? '';
    $prodObj->search($search);
    $response->getBody()->write(json_encode($prodObj->getData()));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/product/{id}', function ($request, $response, $args){    
    $id = $args['id'];
    $prodObj = new Read('marketzone');
    $prodObj->single($id);
    $response->getBody()->write($prodObj->getData());
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/products', function ($request, $response, $args){    
    $prodObj = new Read('marketzone');
    $prodObj->list();
    $response->getBody()->write(json_encode($prodObj->getData()));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->run();
?>
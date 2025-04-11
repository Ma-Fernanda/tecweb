<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/myapi/Products.php';

use TECWEB\MYAPI\Products;

$app = AppFactory::create();

// Instanciar el modelo
$products = new Products("marketzone");

// Ruta raíz
$app->get('/', function ($request, $response) {
    $response->getBody()->write(json_encode(["mensaje" => "API RESTful con Slim 4"]));
    return $response->withHeader('Content-Type', 'application/json');
});

// Obtener todos los productos
$app->get('/productos', function ($request, $response) use ($products) {
    $resultado = $products->list();
    $response->getBody()->write(json_encode($resultado));
    return $response->withHeader('Content-Type', 'application/json');
});

// Obtener un producto por ID
$app->get('/productos/{id}', function ($request, $response, $args) use ($products) {
    $id = $args['id'];
    $resultado = $products->name($id);
    $response->getBody()->write(json_encode($resultado));
    return $response->withHeader('Content-Type', 'application/json');
});

// Crear un producto
$app->post('/productos', function ($request, $response) use ($products) {
    $data = $request->getParsedBody();
    $resultado = $products->add($data);
    $response->getBody()->write(json_encode($resultado));
    return $response->withHeader('Content-Type', 'application/json');
});

// Actualizar un producto
$app->put('/productos/{id}', function ($request, $response, $args) use ($products) {
    $id = $args['id'];
    $data = $request->getParsedBody();
    $resultado = $products->edit($id, $data);
    $response->getBody()->write(json_encode($resultado));
    return $response->withHeader('Content-Type', 'application/json');
});

// Eliminar un producto
$app->delete('/productos/{id}', function ($request, $response, $args) use ($products) {
    $id = $args['id'];
    $resultado = $products->delete($id);
    $response->getBody()->write(json_encode($resultado));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();


?>
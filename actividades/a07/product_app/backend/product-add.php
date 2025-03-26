<?php
  
    namespace TECWEB\MYAPI\Backend;
    require_once __DIR__ . '/Products.php';
    use TECWEB\MYAPI\Products;

    $products = new Products('marketzone', 'root', 'Fernanda465');

    $newProduct = [
        'nombre' => 'Nuevo Producto',
        'marca' => 'Marca Ejemplo',
        'modelo' => 'Modelo Ejemplo',
        'precio' => 99.99,
        'detalles' => 'Detalles del producto',
        'unidades' => 10,
        'imagen' => 'ruta/a/la/imagen.jpg'
    ];

    $products->add($newProduct);

    $response = $products->getData();

    echo $response;

?>
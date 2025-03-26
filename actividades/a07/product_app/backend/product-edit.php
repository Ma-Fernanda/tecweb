<?php

    namespace TECWEB\MYAPI\Backend;
    require_once __DIR__ . '/Products.php';
    use TECWEB\MYAPI\Products;
    $newProduct = [
        'id' => 1, 
        'nombre' => 'Producto Editado',
        'marca' => 'Marca Editada',
        'modelo' => 'Modelo Editado',
        'precio' => 89.99,
        'detalles' => 'Detalles del producto editado',
        'unidades' => 15,
        'imagen' => 'ruta/a/la/nueva/imagen.jpg'
    ];
    
    $products->edit($newProduct);
    
    $response = $products->getData();
    
    echo $response;
    ?>
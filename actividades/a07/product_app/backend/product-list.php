<?php

    namespace TECWEB\MYAPI\Backend;
    require_once __DIR__ . '/Products.php';
    use TECWEB\MYAPI\Products;
    $products = new Products('marketzone', 'root', 'Fernanda465');
    $products->list();
    $response = $products->getData();
    echo $response;

    ?>
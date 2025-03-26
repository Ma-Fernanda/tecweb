<?php

    namespace TECWEB\MYAPI\Backend;
    require_once __DIR__ . '/Products.php';
    use TECWEB\MYAPI\Products;
    $products = new Products('mi_base_de_datos', 'root', 'Fernanda465');

    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    $products->single($id);

    $response = $products->getData();

    echo $response;
?>
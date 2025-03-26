<?php

    namespace TECWEB\MYAPI\Backend;
    require_once __DIR__ . '/Products.php';
    use TECWEB\MYAPI\Products;

    $products = new Products('marketzone', 'root', 'Fernanda465');

    $search = isset($_GET['search']) ? $_GET['search'] : '';

    $products->search($searchTerm);

    $response = $products->getData();

    echo $response;
    ?>
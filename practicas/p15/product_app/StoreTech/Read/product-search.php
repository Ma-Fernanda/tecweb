<?php
    namespace StoteTech\Read;
    use TECWEB\MYAPI\Products;
    require_once __DIR__.'/../Products.php';

    $productos = new Products('marketzone');
    $productos->search( $_GET['search'] );
    echo $productos->getData();
?>
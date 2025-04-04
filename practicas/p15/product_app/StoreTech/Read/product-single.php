<?php
    namespace StoteTech\Read;
    use TECWEB\MYAPI\Products;
    require_once __DIR__.'/../Products.php';

    $productos = new Products('marketzone');
    $productos->single( $_POST['id'] );
    echo $productos->getData();
?>
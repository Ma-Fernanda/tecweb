<?php
    namespace StoteTech\Delete;
    use TECWEB\MYAPI\Products;
    require_once __DIR__.'/../Products.php';

    $productos = new Products('marketzone');
    $productos->delete( $_POST['id'] );
    echo $productos->getData();
?>
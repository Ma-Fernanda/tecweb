<?php
    namespace StoteTech\Read;
    use TECWEB\Products as Products;
    require_once __DIR__.'/../../Products.php';

    $productos = new Products('marketzone');
    $productos->list();
    echo $productos->getData();
?>
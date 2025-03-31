<?php
use TECWEB\MYAPI\Products as Products;
require_once __DIR__ . '/myapi/Products.php';

$products = new Products('marketzone');
$products->edit($_POST);
echo $products->getData();
?>
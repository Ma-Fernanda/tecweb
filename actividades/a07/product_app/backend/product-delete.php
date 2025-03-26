<?php
  
    namespace TECWEB\MYAPI\Backend;
    require_once __DIR__ . '/Products.php';
    use TECWEB\MYAPI\Products;

    $products = new Products('marketzone', 'root', 'Fernanda465');
    $productId;
    $products->delete($productId);
    echo json_encode(['status' => 'success', 'message' => 'Producto eliminado']);
    ?>
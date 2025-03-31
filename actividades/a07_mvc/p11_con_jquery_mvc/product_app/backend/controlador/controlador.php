<?php

use TECWEB\MODELO\Products as Products;
require_once __DIR__ . '/../modelo/Products.php';

$products = new Products('marketzone');

// Detectar la acción
$action = $_GET['action'] ?? null;

switch ($action) {
    case 'list':
        $products->list();
        break;

    case 'add':
        $products->add($_POST);
        break;

    case 'edit':
        $products->edit($_POST);
        break;

    case 'delete':
        $products->delete($_POST);
        break;

    case 'search':
        $products->search($_GET);
        break;

    case 'name':
        $products->name($_GET);
        break;

    case 'single':
        $products->single($_POST);
        break;

    default:
        http_response_code(400);
        echo json_encode(['error' => 'Acción no válida']);
        exit;
}

echo $products->getData();
?>

<?php
    include_once __DIR__.'/database.php';

    if (isset($_GET['nombre']) && !empty($_GET['nombre'])) {
        $nombre = $_GET['nombre'];

        $sql = "SELECT nombre FROM productos WHERE nombre = '$nombre' AND eliminado = 0";
        $result = $conexion->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode(['exists' => true, 'productName' => $row['nombre']]);
        } else {
            echo json_encode(['exists' => false, 'productName' => '']);
        }
    } else {
            echo json_encode(['error' => 'No se recibió el parámetro "nombre".']);
            }
        
?>


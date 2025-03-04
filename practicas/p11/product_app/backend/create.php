<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');
    if(!empty($producto)) {
        // SE TRANSFORMA EL STRING DEL JASON A OBJETO
        $jsonOBJ = json_decode($producto);
        
        if (isset($jsonOBJ->nombre) && isset($jsonOBJ->marca) && isset($jsonOBJ->modelo) && isset($jsonOBJ->precio)) {
            $nombre = $jsonOBJ->nombre;
            $marca = $jsonOBJ->marca;
            $modelo = $jsonOBJ->modelo;

            /**Verificación de datos existentes */
            $query = "SELECT * FROM productos WHERE (nombre = ? AND marca = ? OR marca = ? AND modelo = ?) AND eliminado = 0";
            $stmt = $conexion->prepare($query);
            $stmt->bind_param("ssss", $nombre, $marca,$marca, $modelo);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows > 0){
                echo json_encode(['estatus'=> 'error', 'message' => 'El producto que intenta registrar ya se encuentra en la base de datos.']);
            } else {
                $precio = $jsonOBJ->precio;
                $unidades = isset($jsonOBJ->unidades)? $jsonOBJ->unidades: 0;
                $detalles = isset($jsonOBJ->detalles)? $jsonOBJ->detalles:'';
                $modelo = isset($jsonOBJ->modelo)? $jsonOBJ->modelo:'';
                $imagen = isset($jsonOBJ->imagen)? $jsonOBJ->imagen:'';

                $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) VALUES (?, ?, ?, ?, ?, ?, ?,0)";
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param("sssdsss", $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen);

                if ($stmt->execute()) {
                    echo json_encode (['estatus'=> 'success', 'message' => 'Producto insertado correctamente']);
                } else {
                    echo json_encode (['estatus'=> 'error', 'message' => 'Error al insertar el producto porfavor intentelo de nuevo']);
                }
        }
        $stmt->close();
    } else{
        echo json_encode(['status' => 'error', 'message' => 'Faltan datos necesarios para la inserción.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No se recibió información del producto.']);
}
$conexion->close();
?>
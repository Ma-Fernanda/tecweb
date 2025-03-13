<?php
    include_once __DIR__.'/database.php';
    $id = $_POST['id'];
    $sql = "SELECT * FROM productos WHERE id = $id";
    $result = mysqli_query($conexion, $sql);
    if (!$result) {
        die ('Query Error'.mysqli_error($conexion));
    }
    $json = array();
    while ($row = mysqli_fetch_array($result)) {
        $json[] = array(
            'name' => $row['nombre'],
            'detalles' => $row['detalles'],
            'precio' => $row['precio'],
            'unidades' => $row['unidades'],
            'modelo' => $row['modelo'],
            'marca' => $row['marca'],
            'imagen' => $row['imagen'],
            'id' => $row['id']
        );
    }
    $conexion->close();
    echo json_encode($json[0]);

?>
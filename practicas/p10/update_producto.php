<?php
$link = mysqli_connect("localhost", "root", "Fernanda465", "marketzone");

if ($link === false) {
    die("ERROR: No pudo conectarse con la DB. " . mysqli_connect_error());
}



    $updates = [];

    if (isset($_POST['nombre']) && $_POST['nombre'] != '') {
        $nombre = $_POST['nombre'];
        $updates[] = "nombre='$nombre'";
    }

    if (isset($_POST['marca']) && $_POST['marca'] != '') {
        $marca = $_POST['marca'];
        $updates[] = "marca='$marca'";
    }

    if (isset($_POST['modelo']) && $_POST['modelo'] != '') {
        $modelo = $_POST['modelo'];
        $updates[] = "modelo='$modelo'";
    }

    if (isset($_POST['precio']) && $_POST['precio'] != '') {
        $precio = floatval($_POST['precio']);
        $updates[] = "precio=$precio";
    }

    if (isset($_POST['details']) && $_POST['details'] != '') {
        $detalles = $_POST['details'];
        $updates[] = "details='$detalles'";
    }

    if (isset($_POST['unidades']) && $_POST['unidades'] != '') {
        $unidades = intval($_POST['unidades']);
        $updates[] = "unidades=$unidades";
    }

    if (isset($_POST['imagen']) && $_POST['imagen'] != '') {
        $imagen = $_POST['imagen'];
        $updates[] = "imagen='$imagen'";
    }

    if (count($updates) > 0) {
        $sql = "UPDATE productos SET " . implode(', ', $updates) . " WHERE id=$id";
        if (mysqli_query($link, $sql)) {
            echo "Producto actualizado.";
            echo '<a href="get_productos_xhtml_v2.php">Ver todos los productos</a> | ';
            echo '<a href="get_productos_vigentes_v2.php">Ver productos vigentes</a>';
        } else {
            echo "ERROR: No se ejecutó $sql. " . mysqli_error($link);
        }
    } else {
        echo "ERROR: No se enviaron datos para actualizar el producto.";
    }

mysqli_close($link);
?>

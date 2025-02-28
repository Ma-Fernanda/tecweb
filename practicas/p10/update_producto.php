<?php
$link = mysqli_connect("localhost", "root", "Fernanda465", "marketzone");

if ($link === false) {
    die("ERROR: No pudo conectarse con la DB. " . mysqli_connect_error());
}

if (!isset($_POST['id']) || empty ($_POST['id'])) {
    die("ERROR: ID no ah sido proporcionado.");
} 
    $id = intval($_POST['id']); 


$updates = [];
if (!empty($_POST['nombre'])) {
    $nombre = mysqli_real_escape_string($link, $_POST['nombre']);
    $updates[] = "nombre='$nombre'";
}

if (!empty($_POST['marca'])) {
    $marca = mysqli_real_escape_string($link, $_POST['marca']);
    $updates[] = "marca='$marca'";
}

if (!empty($_POST['modelo'])) {
    $modelo = mysqli_real_escape_string($link, $_POST['modelo']);
    $updates[] = "modelo='$modelo'";
}

if (!empty($_POST['precio'])) {
    $precio = floatval($_POST['precio']);
    $updates[] = "precio=$precio";
}

if (!empty($_POST['detalles'])) {
    $detalles = mysqli_real_escape_string($link, $_POST['detalles']);
    $updates[] = "detalles='$detalles'";
}

if (!empty($_POST['unidades'])) {
    $unidades = intval($_POST['unidades']);
    $updates[] = "unidades=$unidades";
}

if (!empty($_POST['imagen'])) {
    $imagen = mysqli_real_escape_string($link, $_POST['imagen']);
    $updates[] = "imagen='$imagen'";
}

    if (count($updates) > 0) {
        $sql = "UPDATE productos SET " . implode(', ', $updates) . " WHERE id=$id";
        if (mysqli_query($link, $sql)) {
            echo "Producto actualizado.";
            echo '<a href="get_productos_xhtml_v2.php">Ver todos los productos</a>';
            echo '<a href="get_productos_vigentes_v2.php">Ver productos vigentes</a>';
        } else {
            echo "ERROR: No se ejecutó $sql. " . mysqli_error($link);
        }
    } else {
        echo "ERROR: No se enviaron datos para actualizar el producto.";
    }

mysqli_close($link);
?>

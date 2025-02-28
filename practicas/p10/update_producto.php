<?php
$link = mysqli_connect("localhost", "root", "Fernanda465", "marketzone");

if($link === false){
    die("ERROR: No pudo conectarse con la DB. " . mysqli_connect_error());
}

if(isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['precio'])){
    $id = $_POST['id']; 
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];
    $detalles =$_POST['details'];
    $unidades = $_POST['unidades'];
    $imagen   = $_POST['imagen'];
    $eliminado = 0;

    $precio = floatval($precio);
    $unidades = intval($unidades);
    
    $sql = "UPDATE productos SET nombre='$nombre', marca='$marca', modelo='$modelo',precio=$precio, details='$detalles', unidades=$unidades, imagen='$imagen' WHERE id=$id";
    if(mysqli_query($link, $sql)){
        echo "Producto actualizado.";
        echo '<a href="get_productos_xhtml_v2.php">Ver todos los productos</a> | ';
        echo '<a href="get_productos_vigentes_v2.php">Ver productos vigentes</a>';
    } else {
        echo "ERROR: No se ejecutó $sql. " . mysqli_error($link);
    }
} else {
    echo "ERROR: Falta información para actualizar el producto.";
}

mysqli_close($link);
?>

<?php
$nombre = $_POST['name'];
$marca  = $_POST['marca'];
$modelo = $_POST['modelo'];
$precio = $_POST['precio'];
$detalles =$_POST['details'];
$unidades = $_POST['unidades'];
$imagen   = $_POST['imagen'];
$eliminado = 0;

/** SE CREA EL OBJETO DE CONEXION */
@$link = new mysqli('localhost', 'root', 'Fernanda465', 'marketzone');	
/** comprobar la conexión */
if ($link->connect_errno) {
    die('Falló la conexión: '.$link->connect_error.'<br/>');
}

/**Verificación de datos existentes */
$query = "SELECT * FROM productos WHERE nombre = ? AND marca = ? AND modelo = ?";
$stmt = $link->prepare($query);
$stmt->bind_param("sss", $nombre, $marca, $modelo);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    echo "ERROR: El producto que intenta registrar ya se encuentra en la base de datos.";
} else {

    //$sql = "INSERT INTO productos VALUES (NULL, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', {$eliminado})";
    $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("sssdsssi", $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen,$eliminado);

    if ($stmt->execute()) {
        echo "Producto registrado exitosamente.";
        echo "<p><strong>Nombre:</strong> $nombre</p>";
        echo "<p><strong>Marca:</strong> $marca</p>";
        echo "<p><strong>Modelo:</strong> $modelo</p>";
        echo "<p><strong>Precio:</strong> $precio</p>";
        echo "<p><strong>Detalles:</strong> $detalles</p>";
        echo "<p><strong>Unidades:</strong> $unidades</p>";
        echo "<p><strong>Imagen:</strong> $imagen</p>";
       // echo "<p><strong>Eliminado:</strong> $eliminado</p>";
    } else {
        echo "Error al registrar el producto " . $stmt->error;
    }
}
$stmt->close();
$link->close();

?>
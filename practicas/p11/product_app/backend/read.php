<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();
    // SE VERIFICA HABER RECIBIDO LOS PARAMETROS DE NOMBRE DETALLES O MARCA
    if( isset($_POST['busqueda']) ) {
        $busqueda = $_POST['busqueda'];
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        if ( $result = $conexion->query("SELECT * FROM productos WHERE nombre LIKE '%{$busqueda}%' OR marca LIKE '%{$busqueda}%' OR detalles LIKE '%{$busqueda}%'") ) {
            // SE OBTIENEN LOS RESULTADOS
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
                $data[] = $row;
            }
            $result->free();
		} else {
            die('Query Error: '.mysqli_error($conexion));
        }
		$conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>
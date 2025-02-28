<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <SCript>
        function show() {
              var row = event.target.closest("tr");

                // se obtienen los datos de la fila en forma de arreglo
                var data = row.querySelectorAll(".row-data");
                /**
                querySelectorAll() devuelve una lista de elementos (NodeList) que 
                coinciden con el grupo de selectores CSS indicados.
                (ver: https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Selectors)

                En este caso se obtienen todos los datos de la fila con el id encontrado
                y que pertenecen a la clase "row-data".
                */

                var nombre = data[0].innerHTML;
                var marca = data[1].innerHTML;
                var modelo = data[2].innerHTML;
                var precio = data[3].innerHTML;
                var unidades = data[4].innerHTML;
                var detalles = data[5].innerHTML;
                var imagen = data[6].firstChild.getAttribute('img');

                alert("Nombre: " + nombre + "\nMarca: " + marca + "\nModelo: " + modelo + "\nPrecio" + precio
                    + "\nUnidades: " + unidades + "\nDetalles: " + detalles + "\nImagen: " + imagen);

                send2form(nombre, marca, modelo, precio, unidades, detalles, imagen);

            }
        
            function send2form(nombre, marca, modelo, precio, unidades, detalles, imagen) {     
                var urlForm = "formulario_productos_v2.php";
                var propNombre = "nombre="+nombre;
                var propMarca = "marca="+marca;
                var propModelo = "modelo="+modelo;
                var propPrecio = "precio="+precio;
                var propUnidades = "unidades="+unidades;
                var propDetalles = "details="+detalles;
                var propImagen = "imagen="+imagen;

                var url = urlForm+"?"+propNombre+"&"+propMarca+"&"+propModelo+"&"+propPrecio+"&"+propUnidades+"&"+propDetalles+"&"+propImagen;
                window.open(url);
            }
    </SCript>
</head>
<body>
    <h3>Productos</h3>
    <br/>

    <?php
    if (isset($_GET['tope'])) {
        $tope = intval($_GET['tope']);

        @$link = new mysqli('localhost', 'root', 'Fernanda465', 'marketzone');

        if ($link->connect_errno) {
            die('Falló la conexión: ' . $link->connect_error . '<br/>');
        }

        if ($result = $link->query("SELECT * FROM productos WHERE unidades <= $tope AND eliminado = 0")) {
            if ($result->num_rows > 0) {
                echo '<table class="table">';
                echo '<thead class="thead-dark">';
                echo '<tr>';
                echo '<th scope="col">#</th>';
                echo '<th scope="col">Nombre</th>';
                echo '<th scope="col">Marca</th>';
                echo '<th scope="col">Modelo</th>';
                echo '<th scope="col">Precio</th>';
                echo '<th scope="col">Unidades</th>';
                echo '<th scope="col">Detalles</th>';
                echo '<th scope="col">Imagen</th>';
                echo '<th scope="col">Modificar</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    echo '<tr>';
                    echo '<th scope="row">' . htmlspecialchars($row['id']) . '</th>';
                    echo '<td class = "row-data">' . htmlspecialchars($row['nombre']) . '</td>';
                    echo '<td class = "row-data">' . htmlspecialchars($row['marca']) . '</td>';
                    echo '<td class = "row-data">' . htmlspecialchars($row['modelo']) . '</td>';
                    echo '<td class = "row-data">' . htmlspecialchars($row['precio']) . '</td>';
                    echo '<td class = "row-data">' . htmlspecialchars($row['unidades']) . '</td>';
                    echo '<td class = "row-data">' . htmlspecialchars(utf8_encode($row['detalles'])) . '</td>';
                    echo '<td class = "row-data"><img src="' . htmlspecialchars($row['imagen']) . '" alt="Imagen de ' . htmlspecialchars($row['nombre']) . '" style="width: 100px; height: auto;"></td>';
                    echo '<td><input type="button" value="modificar" onclick="show()" /></td>'; 
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p>No se encontraron productos con unidades menores o iguales a ' . htmlspecialchars($tope) . 'y que no estén eliminados . </p>';
            }

            $result->free();
        }

        $link->close();
    } else {
        echo '<p>Parámetro "tope" no detectado...</p>';
    }
    ?>
</body>
</html>
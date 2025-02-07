<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.1//EN”
“http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd”>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title> Practica de Funciones </title>
</head>
<body>
    <?php
//Ejercicio 1
    echo '<h2>Ejercicio 1: Comprueba si un número es múltiplo de 5 y 7</h2>';
    require_once __DIR__ .'/src/funciones.php';

    if(isset($_GET['numero'])) {
        $num = $_GET['numero'];
        echo '<p>' . Multiplo($num). '</p>';
    }
//Ejercicio 2 
    echo '<h2>Ejercicio 2: Generación repetitiva de 3 números aleatorios hasta obtener una
        secuencia compuesta por: impar, par, impar</h2>';

        $resultado = Secuencia();
        $matrizfinal = $resultado['matriz'];
        $iteraciones = $resultado['iteraciones'];
        $numgenerados = $resultado['numgenerados'];

        foreach($matrizfinal as $fila) {
            echo implode (', ', $fila). '<br>';
        }
        echo '<br>';
        echo '<b>'. $numgenerados . '</b> números obtenidos en  <b>' . $iteraciones . '</b> iteraciones</p>';

//Ejercicio 3
        echo '<h2>Ejercicio 3:Utilizar un ciclo while para encontrar el primer número entero obtenido aleatoriamente,
                pero que además sea múltiplo de un número dado.</h2>';

        echo '<p>Porfavor escriba lo siguiente en la dirección URL: ?numero=___ (algún número entre -100 y 100) ';
        if (isset($_GET['numero']) && is_numeric($_GET['numero']) && $_GET['numero'] != 0) {
            echo numAleatorio();
        }

        if (isset($_GET['numero']) && is_numeric($_GET['numero']) && $_GET['numero'] != 0) {
            echo numAleatorio2();
        }   
//Ejercicio 4
        echo '<h2>Ejercicio 4:Crear un arreglo cuyos índices van de 97 a 122 y cuyos valores son las letras de la ‘a’
                a la ‘z’. Usa la función chr(n) que devuelve el caracter cuyo código ASCII es n para poner
                el valor en cada índice. '
    ?>
    <h2>Tabla de Letras ASCII</h2>
    <table border="1.5">
        <tr>
            <th>ASCII</th>
            <th>Letra</th>
        </tr>
        <?php
        $letras = letrasASCII();
        foreach ($letras as $key => $value) {
            echo "<tr>";
            echo "<td>$key</td>";
            echo "<td>$value</td>";
            echo "</tr>";
        }
        ?>
    </table>
<br>
<h2>Ejercicio 5: Validar el sexo del usuario</h2>
    <form action="src/funciones.php" method="POST">
        <br>
            Edad:
            <input type="number" name="edad" id="edad" required>
        <br> <br>
            Sexo:
            <select name="sexo" id="sexo" required>
                <option value="">Seleccione...</option>
                <option value="femenino">Femenino</option>
                <option value="masculino">Masculino</option>
            </select>
        <br> <br>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>
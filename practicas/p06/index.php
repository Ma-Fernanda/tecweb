<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.1//EN”
“http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd”>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title> Practica de Funciones </title>
</head>
<body>
    <h2>Ejercicio 1: Comprueba si un número es múltiplo de 5 y 7</h2>
    <?php
    require_once __DIR__ .'/src/funciones.php';

    if(isset($_GET['numero'])) {
        $num = $_GET['numero'];
        echo '<p>' . Multiplo($num). '</p>';
    }
    
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
    ?>

</body>
</html>
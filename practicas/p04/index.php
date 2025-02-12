<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.1//EN”
“http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd”>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title> Variables </title>
</head>
<body>
    <h2>Ejercicio 1: Validación de variables en PHP</h2>
    <?php
        $_myvar;
        $_7var;
        //myvar;       // Es inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Es invalida
        echo '<ul>';
        echo '<li> $_myvar es variable válida porque empieza con $ seguida de un guión bajo y algun tipo de nomenclatura aceptable en PHP </li>';
        echo '<li>$_7var es variable válida porque empieza con $ seguida de un guión bajo y algun tipo de nomenclatura aceptable en PHP </li>';
        echo '<li>myvar no es variable válida porque no empieza con $ por lo tanto no es aceptable en PHP'. "<br>";
        echo '<li>$myvar es variable válida porque empieza con $ seguida de una letra y algun tipo de nomenclatura aceptable en PHP </li>';
        echo '<li>$var7 es variable válida porque empieza con $ seguida de una letra y algun tipo de nomenclatura aceptable en PHP </li>';
        echo '<li>$_element1 es variable válida porque empieza con $ seguida de un guión bajo y algun tipo de nomenclatura aceptable en PHP </li>';
        echo '<li>$house*5 no es variable válida porque * no es aceptable en PHP </li>'; 
        echo '</ul>';  
    ?>

    <h2>Ejercicio 2: Asignación de valores a variables </h2>
    <?php
        $a = "ManejadorSQL";
        $b = 'MySQL';
        $c = &$a;
        echo "<h3>Asignación</h3>";
        echo " a: $a <br>";
        echo " b: $b <br>";
        echo " c: $c <br>";

        $a = "PHP server";
        $b = &$a;
        echo "<h3>Reasignación</h3>";
        echo " a: $a <br>";
        echo " b: $b <br>";
        echo " c: $c <br>";
    ?>
    <h4>Aquí podemos observar como es el comportamiento de las referencias en las variables, <br>
        en primer lugar las variables: <br>
        $a almacena el valor "ManejadorSQL". <br>
        $b almacena el valor "MySQL". <br>
        $c tiene una referencia a $a, lo que significa que ambas apuntan al mismo valor de memoria. <br>
        Asi que al imprimirlas, ambas variables mostraran "ManejadorSQL". <br>
        Después podemos ver una reasignación a las variables $a y $b, por lo que ahora <br>
        $a = "PHP server" <br>
        $b = &$a  <br>
        Ahora $a cambia su valor y ya que en un inicio $c era una referencia a $a, esta tambien lo cambia. <br>
        $b ahora apunta a $a por lo que es ahora otra referencia a $a. <br>
        En conclusión, los tres valores mostraran el mismo resultado "PHP server". <br>
    </h4>
    <br>
    <h2>Ejercicio 3: Mostrar el contenido de cada variable inmediatamente después de cada asignación</h2> 
    <?php
        $a = "PHP5";
        echo " \$a: $a  <br>";

        $z[] = &$a;
        echo "\$z[]: ";
        print_r($z);
        echo "<br>";

        $b = "5a version de PHP";
        echo "\$b: $b <br>";

        @$c = $b*10;
        echo "\$c: $c <br>";

        $a .= $b;
        echo "\$a: $a <br>";

        $b *= $c;
        echo "\$b: $b <br>";

        $z[0] = "MySQL";
        echo "\$z[0]: ";
        print_r($z);
        echo "<br>";
    ?>
    <br>
    <h2>Ejercicio 4: Leer y mostrar variables con ayuda de la matriz "$GLOBALS"</h2>
    <?php
        $a = "PHP5";
        echo "\$a: " . $GLOBALS['a'] . "<br>";

        $GLOBALS['z'][] = &$a;
        echo "\$z[]: ";
        print_r($GLOBALS['z']);
        echo "<br>";

        $b = "5a version de PHP";
        echo "\$b: " . $GLOBALS['b'] . "<br>";

        @$c = $b * 10;
        echo "\$c: " . $GLOBALS['c'] . "<br>";

        $a .= $b;
        echo "\$a: " . $GLOBALS ['a'] . "<br>";

        $b *= $c;
        echo "\$b: " . $GLOBALS ['b'] . "<br>";

        $z[0] = "MySQL";
        echo "\$z[]: ";
            print_r($GLOBALS['z']);
            echo "<br>";
        
        unset($a, $b, $c, $z)
    ?>
    <h2>Ejercicio 5: Dar el valor de las variables $a, $b, $c al final </h2>
    <?php
        $a = "7 personas";
        $b = (integer) $a;
        $a = "9E3";
        $c = (double) $a;


        echo " \$a: $a  <br>";
        echo "\$b: $b <br>";
        echo "\$c: $c <br>";
    ?> <br>

    <h2>Ejercicio 6:Comprobación de valores booleanos usando la función "var_dump(<datos>)"  </h2>
    <?php
        $a = "0";
        $b = "TRUE";
        $c = FALSE;
        $d = ($a OR $b);
        $e = ($a AND $c);
        $f = ($a XOR $b);

        echo "\$a: ";
        var_dump($a);
        echo "<br>";

        echo "\$b: ";
        var_dump($b); 
        echo "<br>";

        echo "\$c: ";
        var_dump($c); 
        echo "<br>";

        echo "\$d: ";
        var_dump($d); 
        echo "<br>";

        echo "\$e: ";
        var_dump($e); 
        echo "<br>";

        echo "\$f: ";
        var_dump($f); 
        echo "<br>";

        echo "<h3>Transformación de valores booleanos a string para poder ser mostrados con echo </h3>";
        echo "\$c: " . var_export($c, true) . "<br>"; 
        echo "\$e: " . var_export($e, true) . "<br>"; 
    ?>
    <br>
    <h2>Ejercicio 7: Usando la variable predefinida $_SERVER, determina:</h2>
    <?php
        echo "Versión de Apache: " . $_SERVER['SERVER_SOFTWARE'] . "<br>";
        echo "Versión de PHP: " . phpversion() . "<br>";

        echo "Nombre Sistema Operativo: " . PHP_OS . "<br>";

        echo "Idioma del navegador: " . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . "<br>";
    ?>
</body>
</html>
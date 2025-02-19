<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
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
        echo '<li>myvar no es variable válida porque no empieza con $ por lo tanto no es aceptable en PHP'. "</li>" ;
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
        echo " <p>a: $a </p>";
        echo " <p>b: $b </p>";
        echo " <p>c: $c </p>";

        $a = "PHP server";
        $b = &$a;
        echo "<h3>Reasignación</h3>";
        echo " <p>a: $a </p>";
        echo " <p>b: $b </p>";
        echo " <p>c: $c </p>";
    ?>
    <h4>Aquí podemos observar cómo es el comportamiento de las referencias en las variables:</h4>
        <p>
            En primer lugar, las variables:<br />
            $a almacena el valor "ManejadorSQL".<br />
            $b almacena el valor "MySQL".<br />
            $c tiene una referencia a $a, lo que significa que ambas apuntan al mismo valor de memoria.<br />
            Así que al imprimirlas, ambas variables mostrarán "ManejadorSQL".<br />
            Después podemos ver una reasignación a las variables $a y $b, por lo que ahora:<br />
            $a = "PHP server";<br />
            $b = amp$a;<br />
            Ahora $a cambia su valor y ya que en un inicio $c era una referencia a $a, esta también lo cambia.<br />
            $b ahora apunta a $a, por lo que es ahora otra referencia a $a.<br />
            En conclusión, los tres valores mostrarán el mismo resultado "PHP server".
        </p>
    <h2>Ejercicio 3: Mostrar el contenido de cada variable inmediatamente después de cada asignación</h2> 
    <?php
        $a = "PHP5";
        echo "<p> \$a: $a </p>";
        $z =[];
        $z[] = &$a;
        echo "<p>\$z[]: ";
        print_r($z);
        echo "</p>";

        $b = "5a version de PHP";
        echo "<p>\$b: $b </p>";

        @$c = $b*10;
        echo "<p>\$c: $c </p>";

        $a .= $b;
        echo "<p>\$a: $a </p>";

        $b *= $c;
        echo "<p>\$b: $b </p>";

        $z[0] = "MySQL";
        echo "<p>\$z[0]: ";
        print_r($z);
        echo "</p>";
    ?> 
    <h2>Ejercicio 4: Leer y mostrar variables con ayuda de la matriz "$GLOBALS"</h2>
    <?php
        $a = "PHP5";
        echo "<p>\$a: " . $GLOBALS['a'] . "</p>";

        $GLOBALS['z'][] = &$a;
        echo "<p>\$z[]: ";
        print_r($GLOBALS['z']);
        echo "</p>";

        $b = "5a version de PHP";
        echo "<p>\$b: " . $GLOBALS['b'] . "</p>";

        @$c = $b * 10;
        echo "<p>\$c: " . $GLOBALS['c'] . "</p>";

        $a .= $b;
        echo "<p>\$a: " . $GLOBALS ['a'] . "</p>";

        $b *= $c;
        echo "<p>\$b: " . $GLOBALS ['b'] . "</p>";

        $z[0] = "MySQL";
        echo "<p>\$z[]: ";
            print_r($GLOBALS['z']);
            echo "</p>";
        
        unset($a, $b, $c, $z)
    ?>
    <h2>Ejercicio 5: Dar el valor de las variables $a, $b, $c al final </h2>
    <?php
        $a = "7 personas";
        $b = (integer) $a;
        $a = "9E3";
        $c = (double) $a;


        echo " <p>\$a: $a  </p>";
        echo "<p>\$b: $b </p>";
        echo "<p>\$c: $c </p>";
    ?> 

    <h2>Ejercicio 6:Comprobación de valores booleanos usando la función "var_dump(datos)"  </h2>
    <?php
        $a = "0";
        $b = "TRUE";
        $c = FALSE;
        $d = ($a OR $b);
        $e = ($a AND $c);
        $f = ($a XOR $b);

        echo "<p>\$a: ";
        var_dump($a);
        echo "</p>";

        echo "<p>\$b: ";
        var_dump($b); 
        echo "</p>";

        echo "<p>\$c: ";
        var_dump($c); 
        echo "</p>";

        echo "<p>\$d: ";
        var_dump($d); 
        echo "</p>";

        echo "<p>\$e: ";
        var_dump($e); 
        echo "</p>";

        echo "<p>\$f: ";
        var_dump($f); 
        echo "</p>";

        echo "<h3>Transformación de valores booleanos a string para poder ser mostrados con echo </h3>";
        echo "<p>\$c: " . var_export($c, true) . "</p>"; 
        echo "<p>\$e: " . var_export($e, true) . "</p>"; 
    ?>
    
    <h2>Ejercicio 7: Usando la variable predefinida $_SERVER, determina:</h2>
    <?php
        echo "<p>Versión de Apache: " . $_SERVER['SERVER_SOFTWARE'] . "</p>";
        echo "<p>Versión de PHP: " . phpversion() . "</p>";
        echo "<p>Nombre Sistema Operativo: " . PHP_OS . "</p>";
        echo "<p>Idioma del navegador: " . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . "</p>";
    ?>

    <div>
    <p>
    <a href="https://validator.w3.org/markup/check?uri=referer"><img
      src="https://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" /></a>
  </p>
    </div>
</body>
</html>
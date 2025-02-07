<?php
//función multiplo
    function Multiplo($num){
            if ($num%5==0 && $num%7==0){
                echo '<h3> El número '. $num. ' SÍ es múltiplo de 5 y de 7 </h3>';
            } else{
                echo '<h3> El número '. $num .' NO es múltplo de 5 y 7 </h3>';
            }
    }
//función secuencia
    function Secuencia() {
        $matriz = [];
        $iteraciones = 0;
        $numgenerados = 0;
        while(true) {
            $iteraciones++;
            $fila = [];
            for ($i = 0; $i < 3; $i++){
                $fila[] = rand(0, 500);
            }
            $matriz[] = $fila;
            $numgenerados += 3;
            if($fila[0]%2 !=0 && $fila[1]%2 ==0 && $fila[2]%2 !=0) {
                break;
            }
        }
        return [
            'matriz' => $matriz,
            'iteraciones' => $iteraciones,
            'numgenerados' => $numgenerados];
    }

//función numero entero aleatorio
    function numAleatorio(){
        $numusuario = intval($_GET['numero']);
        if($numusuario>=-100 && $numusuario <=100){
        $numAleatorio = 0;
        while(true){
            $numAleatorio = rand (-100, 100);

            if($numAleatorio % $numusuario == 0){
                break;
            }
        }
        echo '<p>Número encontrado con while: <b>' . $numAleatorio. '</b> es múltiplo de <b>' .$numusuario .'</b></p>';
    }else{
        echo '<p>El número ingresado no se encuentra en el rango de -100 a 100, porfavor inténtelo de nuevo';
        }
}

    function numAleatorio2() {
        $numusuario = intval($_GET['numero']);
        if($numusuario>=-100 && $numusuario <=100){
        $numAleatorio = 0;

        do {
            $numAleatorio = rand (-100, 100); 
        } while($numAleatorio % $numusuario != 0);
        echo '<p>Número encontrado con do-while: <b>' . $numAleatorio. '</b> es múltiplo de <b>' .$numusuario .'</b></p>';
    }else{
        echo '<p>El número ingresado no se encuentra en el rango de -100 a 100, porfavor inténtelo de nuevo';
        }
}

//función arreglo con tabla y ASCII
    function letrasASCII() {
        $letras = [];
        for ($i = 97; $i <= 122; $i++) {
            $letras[$i] = chr($i);
        }
        return $letras; 
    }
?>

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


?>
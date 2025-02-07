<?php
    function Multiplo($num){
            if ($num%5==0 && $num%7==0){
                echo '<h3> El número '. $num. ' SÍ es múltiplo de 5 y de 7 </h3>';
            } else{
                echo '<h3> El número '. $num .' NO es múltplo de 5 y 7 </h3>';
            }
    }


?>
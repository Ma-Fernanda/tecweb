<?php
namespace TECWEB\MYAPI;
abstract class DataBase {
    protected $conexion;

    public function __construct($user, $pass, $db){
        $this-> conexion = @mysqli_connnect
        (   'localhost',
            $user,
            $pass,
            $db );
        if (!$this->conexion) {
            die ('¡Base de datos NO conectada!');
        }
    }
}

?>

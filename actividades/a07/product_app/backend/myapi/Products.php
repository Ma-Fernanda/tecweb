<?php
namespace TECWEB\MYAPI;

use TECWEB\MYAPI\DataBase as DataBase;
require_once __DIR__ . '/DataBase.php';

class Products extends DataBase {
    private $data = NULL;
    public function __construct($db, $user= 'root', $pass= 'Fernanda465'){
        $this->data = array();
        parent::__construct($user, $pass, $db);
    }
    public function singleByName($name){
        $query = "SELECT * FROM productos WHERE name = ? ";
        $sql = $this->conexion->prepare($query);
        $sql->bind_param("s", $name);
        $sql->execute();
        $result = $sql->get_result();
        $this->data = $result->fetch_all(MYSQLI_ASSOC);
        $sql->close();
    }
    public function getData(){
        return  json_encode($this->data, JSON_PRETTY_PRINT);
    }
    public function list(){
        $this->data = array();
        if ($result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0")) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if(!is_null($rows)){
                foreach($rows as $num=>$row){
                    foreach($row as $key=>$value){
                        $this->data[$num][$key] = $value;
                    }
                }
            }
            $result->free();
        } else {
            die ('Query Error: ' .mysqli_error($this->conexion));
        } $this->conexion->close();
    }
    public function add($producto) {
        $query = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) VALUES (?, ?, ?, ?, ?, ?, ?, 0)";
        $sql = $this->conexion->prepare($query);
        $sql->bind_param("sssdiss", $producto['nombre'], $producto['marca'], $producto['modelo'], $producto['precio'], $producto['detalles'], $producto['unidades'], $producto['imagen']);
        
        $data = [];
        if ($sql->execute()) {
            $data['status'] = "success";
            $data['message'] = "Producto agregado";
        } else {
            $data['status'] = "error";
            $data['message'] = "ERROR: No se ejecutó la consulta. " . mysqli_error($this->conexion);
        }
        $sql->close();
    
        return json_encode($data, JSON_PRETTY_PRINT);
    }
    
    public function delete($id) {
        $query = "DELETE FROM productos WHERE id = ?";
        $sql = $this->conexion->prepare($query);
        $sql->bind_param("i", $id);
    
        $data = [];
        if ($sql->execute()) {
            $data['status'] = "success";
            $data['message'] = "Producto eliminado correctamente";
        } else {
            $data['status'] = "error";
            $data['message'] = "Error al eliminar el producto: " . $this->conexion->error;
        }
        $sql->close();
        
        return json_encode($data, JSON_PRETTY_PRINT);
    }
    
    public function edit($producto) {
        $query = "UPDATE productos SET nombre = ?, marca = ?, modelo = ?, precio = ?, detalles = ?, unidades = ?, imagen = ? WHERE id = ?";
        $sql = $this->conexion->prepare($query);
        $sql->bind_param("sssdissi", $producto['nombre'], $producto['marca'], $producto['modelo'], $producto['precio'], $producto['detalles'], $producto['unidades'], $producto['imagen'], $producto['id']);
        
        $data = [];
        if ($sql->execute()) {
            $data['status'] = "success";
            $data['message'] = "Producto actualizado correctamente";
        } else {
            $data['status'] = "error";
            $data['message'] = "Error al actualizar el producto: " . $this->conexion->error;
        }
        $sql->close();
        
        return json_encode($data, JSON_PRETTY_PRINT);
    }
    
    public function search($search) {
        $query = "SELECT * FROM productos WHERE (id = ? OR nombre LIKE ? OR marca LIKE ? OR detalles LIKE ?) AND eliminado = 0";
        $sql = $this->conexion->prepare($query);
        $searchParam = "%$search%";
        $sql->bind_param("isss", $search, $searchParam, $searchParam, $searchParam);
        $sql->execute();
        $result = $sql->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $sql->close();
        return $rows;
    }    
    
    public function single($id) {
        $query = "SELECT * FROM productos WHERE id = ?";
        $sql = $this->conexion->prepare($query);
        $sql->bind_param("i", $id);
        $sql->execute();
    
        $result = $sql->get_result();
        $data = $result->fetch_assoc();
        $sql->close();
    
        return json_encode($data, JSON_PRETTY_PRINT);
    }
}
?>    
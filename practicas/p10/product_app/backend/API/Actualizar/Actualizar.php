<?php
namespace API\Actualizar;
use API\BD\DataBase;
require_once __DIR__ . '/../BD/DataBase.php';

class Actualizar extends DataBase{
     // Método para actualizar un producto con la información enviada por el cliente
 public function actualizarProducto($productoJSON){ 
    $data = array(
        'status' => 'error',
        'message' => 'No es posible actualizar'
    );

    if (isset($productoJSON)) {
        // Convierte el JSON en un objeto
        $jsonOBJ = json_decode($productoJSON);

        $sql_1 = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' and marca = '{$jsonOBJ->marca}' and modelo = '{$jsonOBJ->modelo}' and precio = {$jsonOBJ->precio} and detalles = '{$jsonOBJ->detalles}' and unidades = {$jsonOBJ->unidades} and imagen = '{$jsonOBJ->imagen}'";

        $res = $this->conexion->query($sql_1);

        if ($res->num_rows == 0) {
            // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE
            $sql = "UPDATE productos SET nombre = '{$jsonOBJ->nombre}', marca = '{$jsonOBJ->marca}', modelo = '{$jsonOBJ->modelo}', precio = {$jsonOBJ->precio}, detalles = '{$jsonOBJ->detalles}', unidades = {$jsonOBJ->unidades}, imagen = '{$jsonOBJ->imagen}' WHERE id = '{$jsonOBJ->id}'";
            
            $this->conexion->set_charset("utf8");
            if ($this->conexion->query($sql)) {
                $data['status'] =  "success";
                $data['message'] =  "Producto actualizado";
            } else {
                $data['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion);
            }
        } else {
            $data['status'] =  "success";
            $data['message'] =  "No es una actualización si son los mismos datos";
        }
        $this->conexion->close();
    }
    return $data;
}

}
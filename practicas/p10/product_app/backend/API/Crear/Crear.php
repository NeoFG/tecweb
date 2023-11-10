<?php
namespace API\Crear;
use API\BD\DataBase;
require_once __DIR__ . '/../BD/DataBase.php';

class Crear extends DataBase{
    // Método para agregar un producto a partir de la información enviada por el cliente
    public function agregarProductoDesdeCliente($productoJSON) {
        $data = array(
            'status' => 'error',
            'message' => 'CON coincidencias en la BD'
        );
        // Verifica si se ha proporcionado información del producto
        if (!empty($productoJSON)) {
            // Convierte el JSON en un objeto
            $jsonOBJ = json_decode($productoJSON);
            // Valida que el nombre del producto no exista en la base de datos
            $nombreProducto = $jsonOBJ->nombre;
            $sqlVerificarNombre = "SELECT COUNT(*) as count FROM productos WHERE nombre = '$nombreProducto' AND eliminado = 0";
            $resultVerificarNombre = $this->conexion->query($sqlVerificarNombre);
            if ($resultVerificarNombre && $row = $resultVerificarNombre->fetch_assoc()) {
                $count = $row['count'];
                if ($count == 0) {
                    // El nombre no existe en la base de datos, se puede insertar el producto
                    $this->conexion->set_charset("utf8");
                    $sql = "INSERT INTO productos VALUES (null, '{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', 
                    '{$jsonOBJ->modelo}', {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, '{$jsonOBJ->imagen}', 0)";

                    if ($this->conexion->query($sql)) {
                        $data['status'] = "success";
                        $data['message'] = 'SIN coincidencias en la BD, Producto Agregado';
                    } else {
                        $data['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion);
                    }
                }
            }
            $resultVerificarNombre->free();
        }
        return $data;
    }

}
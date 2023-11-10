<?php
namespace API\Eliminar;
use API\BD\DataBase;
require_once __DIR__ . '/../BD/DataBase.php';

class Eliminar extends DataBase{
    // Método para eliminar un producto en la base de datos
    public function eliminarProducto($id) {
        $data = array(
            'status'  => 'error',
            'message' => 'La consulta falló'
        );

        // Verifica si se ha recibido un ID
        if (isset($id)) {
            // Realiza la consulta de eliminación
            $sql = "UPDATE productos SET eliminado=1 WHERE id = {$id}";

            if ($this->conexion->query($sql)) {
                $data['status'] =  "success";
                $data['message'] =  "Producto eliminado";
            } else {
                $data['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();
        }
        return $data;
    }
}
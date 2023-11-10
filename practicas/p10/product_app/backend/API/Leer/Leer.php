<?php
namespace API\Leer;
use API\BD\DataBase;
require_once __DIR__ . '/../BD/DataBase.php';

class Leer extends DataBase{
     // Método para obtener la lista de productos desde la base de datos
     public function obtenerListaProductos() {
        $data = array();

        // Realiza la consulta de búsqueda y al mismo tiempo valida si hubo resultados
        if ($result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0")) {
            // Obtiene los resultados
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if (!is_null($rows)) {
                foreach ($rows as $num => $row) {
                    foreach ($row as $key => $value) {
                        $data[$num][$key] = ($value);
                    }
                }
            }
            $result->free();
        } else {
            throw new \Exception('Query Error: ' . mysqli_error($this->conexion));
        }
        return $data;
    }

     // Método para buscar productos en la base de datos
     public function buscarProductos($search) {
        $data = array();
        // Realiza la consulta de búsqueda y al mismo tiempo valida si hubo resultados
        $sql = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' 
        OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
        if ($result = $this->conexion->query($sql)) {
            // Obtiene los resultados
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if (!is_null($rows)) {
                foreach ($rows as $num => $row) {
                    foreach ($row as $key => $value) {
                        $data[$num][$key] = ($value);
                    }
                }
            }
            $result->free();
        } else {
            throw new \Exception('Query Error: ' . mysqli_error($this->conexion));
        }
        return $data;
    }

    // Método para obtener un producto por su ID
    public function obtenerProductoPorId($id) {
        if (isset($id)) {
            $this->conexion->set_charset("utf8");
            $sql = "SELECT * from productos WHERE id = {$id}";

            $result = $this->conexion->query($sql);

            $json = array();
            while ($row = mysqli_fetch_array($result)) {
                $json[] = array(
                    'nombre' => $row['nombre'],
                    'precio' => $row['precio'],
                    'unidades' => $row['unidades'],
                    'modelo' => $row['modelo'],
                    'marca' => $row['marca'],
                    'detalles' => $row['detalles'],
                    'imagen' => $row['imagen'],
                    'id' => $row['id']
                );
            }
            return json_encode($json[0]);
        }
        return null;
    }
}
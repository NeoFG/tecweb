<?php
namespace database; 
require_once 'DataBase.php';
class Productos extends DataBase {
    public function __construct($database = "marketzone") {
        parent::__construct($database); // llama al constructor
        $this->response = array(); // inicializa 
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
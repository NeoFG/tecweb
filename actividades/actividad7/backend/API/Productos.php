<?php
    namespace database;
    require_once 'DataBase.php';
    class Productos extends DataBase {
        public function __construct($database = "marketzone") {
            parent::__construct($database); // llama al constructor
            $this->response = array(); // inicializa 
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
?>
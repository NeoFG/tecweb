<?php
    namespace MyDatabase;

    class Productos extends DataBase {
        
        private array $response = [];

        public function __construct(string $dbName = 'marketzone') {
            parent::__construct($dbName);
        }

        public function getResponse(): string {
            return json_encode($this->response, JSON_PRETTY_PRINT);
        }

        public function add($data): void {
            // $data es un objeto que contiene la información del nuevo producto

            // Convierte el objeto $data en un array asociativo para obtener los valores
            $dataArray = (array) $data;

            // Prepara los valores para la inserción en la base de datos
            $nombre = $this->conexion->real_escape_string($dataArray['nombre']);
            $marca = $this->conexion->real_escape_string($dataArray['marca']);
            $modelo = $this->conexion->real_escape_string($dataArray['modelo']);
            $precio = (float) $dataArray['precio'];
            $detalles = $this->conexion->real_escape_string($dataArray['detalles']);
            $unidades = (int) $dataArray['unidades'];
            $imagen = $this->conexion->real_escape_string($dataArray['imagen']);

            // Realiza la inserción en la base de datos
            $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) 
                    VALUES ('$nombre', '$marca', '$modelo', $precio, '$detalles', $unidades, '$imagen', 0)";

            if ($this->conexion->query($sql)) {
                // La inserción fue exitosa, puedes configurar una respuesta de éxito si es necesario
                $this->response = [
                    'status' => 'success',
                    'message' => 'Producto agregado'
                ];
            } else {
                // Si hay un error en la inserción, captura el mensaje de error de MySQL
                $errorMessage = $this->conexion->error;
                $this->response = [
                    'status' => 'error',
                    'message' => "Error al agregar el producto: $errorMessage"
                ];
            }
        }


        public function delete(string $id): void {
            // Sanitiza y valida el ID
            $id = $this->conexion->real_escape_string($id);

            // Realiza la eliminación en la base de datos
            $sql = "UPDATE productos SET eliminado = 1 WHERE id = $id";

            if ($this->conexion->query($sql)) {
                // La eliminación fue exitosa, puedes configurar una respuesta de éxito si es necesario
                $this->response = [
                    'status' => 'success',
                    'message' => 'Producto eliminado'
                ];
            } else {
                // Si hay un error en la eliminación, captura el mensaje de error de MySQL
                $errorMessage = $this->conexion->error;
                $this->response = [
                    'status' => 'error',
                    'message' => "Error al eliminar el producto: $errorMessage"
                ];
            }
        }


        public function edit($data): void {
            // $data es un objeto que contiene la información actualizada del producto

            // Convierte el objeto $data en un array asociativo para obtener los valores
            $dataArray = (array) $data;

            // Prepara los valores para la actualización en la base de datos
            $id = (int) $dataArray['id'];
            $nombre = $this->conexion->real_escape_string($dataArray['nombre']);
            $marca = $this->conexion->real_escape_string($dataArray['marca']);
            $modelo = $this->conexion->real_escape_string($dataArray['modelo']);
            $precio = (float) $dataArray['precio'];
            $detalles = $this->conexion->real_escape_string($dataArray['detalles']);
            $unidades = (int) $dataArray['unidades'];
            $imagen = $this->conexion->real_escape_string($dataArray['imagen']);

            // Realiza la actualización en la base de datos
            $sql = "UPDATE productos SET nombre = '$nombre', marca = '$marca', modelo = '$modelo',
                    precio = $precio, detalles = '$detalles', unidades = $unidades, imagen = '$imagen'
                    WHERE id = $id";

            if ($this->conexion->query($sql)) {
                // La actualización fue exitosa, puedes configurar una respuesta de éxito si es necesario
                $this->response = [
                    'status' => 'success',
                    'message' => 'Producto actualizado'
                ];
            } else {
                // Si hay un error en la actualización, captura el mensaje de error de MySQL
                $errorMessage = $this->conexion->error;
                $this->response = [
                    'status' => 'error',
                    'message' => "Error al actualizar el producto: $errorMessage"
                ];
            }
        }


        public function list(): void {
            // Realiza la consulta para obtener la lista de productos desde la base de datos
            $sql = "SELECT * FROM productos WHERE eliminado = 0";

            $result = $this->conexion->query($sql);

            if ($result) {
                $rows = $result->fetch_all(MYSQLI_ASSOC);
                $this->response = $rows;
            } else {
                // Si hay un error en la consulta, captura el mensaje de error de MySQL
                $errorMessage = $this->conexion->error;
                $this->response = [
                    'status' => 'error',
                    'message' => "Error al listar los productos: $errorMessage"
                ];
            }
        }


        public function search(string $term): void {
            // Sanitiza y valida el término de búsqueda
            $term = $this->conexion->real_escape_string($term);

            // Realiza la consulta para buscar productos en la base de datos
            $sql = "SELECT * FROM productos WHERE (id = '$term' OR nombre LIKE '%$term%' OR marca LIKE '%$term%' OR detalles LIKE '%$term%') AND eliminado = 0";

            $result = $this->conexion->query($sql);

            if ($result) {
                $rows = $result->fetch_all(MYSQLI_ASSOC);
                $this->response = $rows;
            } else {
                // Si hay un error en la consulta, captura el mensaje de error de MySQL
                $errorMessage = $this->conexion->error;
                $this->response = [
                    'status' => 'error',
                    'message' => "Error al buscar productos: $errorMessage"
                ];
            }
        }


        public function single(string $id): void {
            // Sanitiza y valida el ID
            $id = $this->conexion->real_escape_string($id);

            // Realiza la consulta para obtener un solo producto desde la base de datos
            $sql = "SELECT * FROM productos WHERE id = '$id'";

            $result = $this->conexion->query($sql);

            if ($result) {
                $row = $result->fetch_assoc();
                $this->response = $row;
            } else {
                // Si hay un error en la consulta, captura el mensaje de error de MySQL
                $errorMessage = $this->conexion->error;
                $this->response = [
                    'status' => 'error',
                    'message' => "Error al obtener el producto: $errorMessage"
                ];
            }
        }
    }
?>

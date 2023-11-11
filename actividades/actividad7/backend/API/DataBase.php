<?php
    namespace database;
    
    abstract class DataBase {
        protected $conexion;
        protected $response;
        public function __construct($database = "marketzone") {
            $this->conexion = @mysqli_connect(
                'localhost',
                'root',
                '123456',
                $database
            );
            // Si la conexión falló, $this->conexion contendrá false
            if (!$this->conexion) {
                die('¡Base de datos NO conectada!');
            }
            $this->response = array();
        }
        public function getResponse() {
            // Realiza la conversión de un array a JSON
            return json_encode($this->response, JSON_PRETTY_PRINT);
        }
    }
?>
<?php
use API\Crear\Crear;
require_once __DIR__.'/API/start.php';

//$productos = new Productos('marketzone');
$productos = new Crear('marketzone');

// Verifica si se ha enviado información del producto desde el cliente
if ($productoJSON = file_get_contents('php://input')) {
    // Llama a la función para agregar un producto desde la información del cliente
    $resultadoAgregacion = $productos->agregarProductoDesdeCliente($productoJSON);
    // Devuelve el resultado de la agregación en formato JSON
    echo json_encode($resultadoAgregacion, JSON_PRETTY_PRINT);
} else {
    $response = array('status' => 'error', 'message' => 'No se recibió información del producto');
    echo json_encode($response, JSON_PRETTY_PRINT);
}

?>
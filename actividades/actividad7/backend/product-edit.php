<?php
use database\Productos;

require_once __DIR__.'/API/Productos.php';
$productos = new Productos('marketzone');

// Verifica si se ha enviado información del producto desde el cliente
if ($productoJSON = file_get_contents('php://input')) {
    // Llama a la función para actualizar el producto con la información del cliente
    $resultadoActualizacion = $productos->actualizarProducto($productoJSON);

    // Devuelve el resultado de la actualización en formato JSON
    echo json_encode($resultadoActualizacion, JSON_PRETTY_PRINT);
} else {
    $response = array('status' => 'error', 'message' => 'No se recibió información del producto');
    echo json_encode($response, JSON_PRETTY_PRINT);
}

?>

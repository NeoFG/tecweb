<?php
use API\Leer\Leer;
require_once __DIR__.'/API/start.php';

//$productos = new Productos('marketzone');
$productos = new Leer('marketzone');

// Verifica si se ha enviado un parámetro ID
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Llama a la función para obtener el producto por su ID
    $producto = $productos->obtenerProductoPorId($id);
    if ($producto) {
        // Devuelve el producto en formato JSON
        echo $producto;
    } else {
        $response = array('status' => 'error', 'message' => 'No se encontró el producto');
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
} else {
    $response = array('status' => 'error', 'message' => 'No se proporcionó un ID');
    echo json_encode($response, JSON_PRETTY_PRINT);
}

?>
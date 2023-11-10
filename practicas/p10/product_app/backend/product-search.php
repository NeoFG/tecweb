<?php
use API\Leer\Leer;
require_once __DIR__.'/API/start.php';

// Crea una instancia de la clase Productos
//$productos = new Productos('marketzone');
$productos = new Leer('marketzone');

// Verifica si se ha enviado un parámetro de búsqueda
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    // Llama a la función para buscar productos y pasa el valor de búsqueda
    $resultadoBusqueda = $productos->buscarProductos($search);
    // Devuelve el resultado de la búsqueda en formato JSON
    echo json_encode($resultadoBusqueda, JSON_PRETTY_PRINT);
} else {
    $response = array('status' => 'error', 'message' => 'No se proporcionó un parámetro de búsqueda (search)');
    echo json_encode($response, JSON_PRETTY_PRINT);
}

?>
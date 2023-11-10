<?php
    use API\Leer\Leer;

    require_once __DIR__.'/API/start.php';
    
    // Crea una instancia de la clase Productos
    //$productos = new Productos('marketzone');
    $productos = new Leer('marketzone');
    $listaProductos = $productos->obtenerListaProductos();
    // Devuelve la lista de productos en formato JSON
    echo json_encode($listaProductos, JSON_PRETTY_PRINT);
    
?>
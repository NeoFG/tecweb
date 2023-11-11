<?php
    use database\Productos;

    require_once __DIR__.'/API/Productos.php';
    
    // Crea una instancia de la clase Productos
    $productos = new Productos('marketzone');
    $listaProductos = $productos->obtenerListaProductos();
    // Devuelve la lista de productos en formato JSON
    echo json_encode($listaProductos, JSON_PRETTY_PRINT);
    
?>
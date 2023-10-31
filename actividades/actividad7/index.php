<?php
    require_once 'DataBase.php';
    require_once 'Productos.php';

    use MyDatabase\Productos;

    $productos = new Productos();

    // Ejemplo de cómo usar el método "add"
    /*
    $newProductData = [
        'nombre' => 'Nuevo Producto',
        'marca' => 'Marca',
        'modelo' => 'Modelo',
        'precio' => 99.99,
        'detalles' => 'Detalles del nuevo producto',
        'unidades' => 10,
        'imagen' => 'imagen.jpg',
    ];

    $productos->add((object)$newProductData); // Agregar un nuevo producto
    $response = $productos->getResponse();
    echo $response;
    */

    // Ejemplo de cómo usar el método "delete" lo pone en 1 que siginifica que se elimino olvide eso jajaa
    $productIDToDelete = '22'; // ID del producto a eliminar
    $productos->delete($productIDToDelete); // Eliminar un producto
    $response = $productos->getResponse();
    echo $response;

    

    // Ejemplo de cómo usar el método "edit"
    /*
    $productToUpdate = [
        'id' => '2', // ID del producto a actualizar
        'nombre' => 'Producto Actualizado',
        'marca' => 'Nueva Marca',
        'modelo' => 'Nuevo Modelo',
        'precio' => 129.99,
        'detalles' => 'Detalles actualizados',
        'unidades' => 15,
        'imagen' => 'nueva_imagen.jpg',
    ];

    $productos->edit((object)$productToUpdate); // Actualizar un producto
    $response = $productos->getResponse();
    echo $response;
    */

    // Ejemplo de cómo usar el método "search"
    /*
    $searchTerm = 'Gucci'; // Término de búsqueda
    $productos->search($searchTerm); // Buscar productos que coincidan con el término
    $response = $productos->getResponse();
    echo $response;
    */

    // Ejemplo de cómo usar el método "single"
    /*
    $productIDToRetrieve = '3'; // ID del producto a obtener
    $productos->single($productIDToRetrieve); // Obtener un solo producto por ID
    $response = $productos->getResponse();
    echo $response;
    */
?>

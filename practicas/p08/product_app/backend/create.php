<?php
include_once __DIR__.'/database.php';

// SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
$producto = file_get_contents('php://input');
if (!empty($producto)) {
    // SE TRANSFORMA EL STRING DEL JSON A OBJETO
    $jsonOBJ = json_decode($producto);

    // Validar que el producto no exista en la base de datos antes de la inserción
    $nombre = $jsonOBJ->nombre;
    $marca = $jsonOBJ->marca;
    $modelo = $jsonOBJ->modelo;
    $precio = $jsonOBJ->precio;
    $detalles = $jsonOBJ->detalles;
    $unidades = $jsonOBJ->unidades;
    $imagen = $jsonOBJ->imagen;
    $eliminado = 0; // Suponiendo que 0 significa no eliminado

    // Realiza la validación en la base de datos
    $conexion = @mysqli_connect('localhost', 'root', '123456', 'marketzone');

    if (!$conexion) {
        die('¡Base de datos NO conectada!');
    }

    $stmt = $conexion->prepare("SELECT id FROM productos WHERE nombre = ? AND eliminado = ?");
    $stmt->bind_param("si", $nombre, $eliminado);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo 'El producto ya existe en la base de datos.';
    } else {
        // La inserción en la base de datos se realiza aquí
        $stmt = $conexion->prepare("INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssdsssi", $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen, $eliminado);

        if ($stmt->execute()) {
            echo 'Producto insertado con éxito.';
        } else {
            echo 'Error al insertar el producto en la base de datos.';
        }
    }

    $stmt->close();
    mysqli_close($conexion);
}
?>

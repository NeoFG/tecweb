<?php
include_once __DIR__ . '/database.php';

// SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
$producto = file_get_contents('php://input');
$data = array(
    'status'  => 'error',
    'message' => 'CON coincidencias en la BD'
);

if (!empty($producto)) {
    // SE TRANSFORMA EL STRING DEL JSON A OBJETO
    $jsonOBJ = json_decode($producto);

    // SE VALIDA QUE EL NOMBRE DEL PRODUCTO NO EXISTA EN LA BASE DE DATOS
    $nombreProducto = $jsonOBJ->nombre;
    $sqlVerificarNombre = "SELECT COUNT(*) as count FROM productos WHERE nombre = '$nombreProducto' AND eliminado = 0";
    $resultVerificarNombre = $conexion->query($sqlVerificarNombre);

    if ($resultVerificarNombre && $row = $resultVerificarNombre->fetch_assoc()) {
        $count = $row['count'];

        if ($count == 0) {
            // El nombre no existe en la base de datos, se puede insertar el producto
            $conexion->set_charset("utf8");
            $sql = "INSERT INTO productos VALUES (null, '{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, '{$jsonOBJ->imagen}', 0)";
            
            if ($conexion->query($sql)) {
                $data['status'] =  "success";
                $data['message'] =  'SIN coincidencias en la BD, Producto Agregado';
            } else {
                $data['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($conexion);
            }
        }
    }

    $resultVerificarNombre->free();
    // Cierra la conexión
    $conexion->close();
}

// SE HACE LA CONVERSIÓN DE ARRAY A JSON
echo json_encode($data, JSON_PRETTY_PRINT);
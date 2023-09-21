<?php
    // Verificar si el parámetro "tope" está presente en la url
    // Lo validamos con el isset y el Get para jalarlo desde el url
    if(isset($_GET['tope'])) {
        $tope = $_GET['tope'];
    } else {
        // Si no esta que me diga esto
        die('Parámetro "tope" no detectado...');
    }

    // Crear una conexión a la base de datos 
    $link = new mysqli('localhost', 'root', '123456', 'marketzone');

    // Verificar la conexión
    if ($link->connect_errno) {
        die('Falló la conexión: ' . $link->connect_error);
    }

    // Consultar la base de datos para obtener productos con unidades <= $tope
    $query = "SELECT * FROM productos WHERE unidades <= $tope";
    $result = $link->query($query);

    // Iniciamos el documento XHTML
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">';
    echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">';
    echo '<head>';
    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
    echo '<title>Productos</title>';
    // Pongo la referencia a Bootstrap CSS para jalar sus disenios
    echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
    echo '</head>';
        echo '<body>';
            // Valido con el if si se encontraron productos
            if ($result->num_rows > 0) {
                echo '<h2 class="mt-3">Productos con unidades menores o iguales a ' . $tope . '</h2>';
                // Agregar clases de Bootstrap a la tabla
                echo '<table class="table table-striped">';
                echo '<thead class="thead-dark">';
                echo '<tr>';
                echo '<th>ID</th>';
                echo '<th>Nombre</th>';
                echo '<th>Marca</th>';
                echo '<th>Modelo</th>';
                echo '<th>Precio</th>';
                echo '<th>Unidades</th>';
                echo '<th>Detalles</th>';
                echo '<th>Imagen</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                // Utilizo el el while para imprimir los resultados y mostrar cada producto en una fila de la tabla que creo.
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['nombre'] . '</td>';
                    echo '<td>' . $row['marca'] . '</td>';
                    echo '<td>' . $row['modelo'] . '</td>';
                    echo '<td>' . $row['precio'] . '</td>';
                    echo '<td>' . $row['unidades'] . '</td>';
                    echo '<td>' . utf8_encode($row['detalles']) . '</td>';
                    echo '<td><img src="' . $row['imagen'] . '" alt="Imagen del producto" class="img-fluid rounded" /></td>';
                
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p>No se encontraron productos con unidades menores o iguales a ' . $tope . '</p>';
            }
            // Cerrar la conexión y finalizar el documento XHTML
            $result->free(); // limpio el link de mi consulta
            $link->close(); // cierro la conexion
        echo '</body>'; 
    echo '</html>';
?>

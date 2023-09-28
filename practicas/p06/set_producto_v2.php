<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST["nombre"];
        $marca = $_POST["marca"];
        $modelo = $_POST["modelo"];
        $precio = $_POST["precio"];
        $detalles = $_POST["detalles"];
        $unidades = $_POST["unidades"];
        
        // Validar que ningún dato esté vacío
        if (empty($nombre) || empty($marca) || empty($modelo) || empty($precio) || empty($detalles) || empty($unidades)) {
            echo "Error: Todos los campos son obligatorios.";
        } else {
            // Validar que el precio sea un número con punto decimal
            if (!is_numeric($precio) || strpos($precio, ',') !== false) {
                echo "Error: El precio debe ser un número con punto decimal.";
            } else {
                // Procesar la imagen
                $imagen = $_FILES["imagen"];
                $nombreImagen = $imagen["name"];
                $rutaImagen = "img/" . $nombreImagen;

                // Insertar en la BD (Aquí debes agregar la conexión a tu base de datos)
                $servername = "localhost";
                $username = "root";
                $password = "123456";
                $database = "marketzone";

                // Conexión a la base de datos
                $link = new mysqli($servername, $username, $password, $database);

                // Verificar la conexión
                if ($link->connect_error) {
                    die("Error en la conexión a la base de datos: " . $link->connect_error);
                }

                // Crear la consulta SQL
                $sql = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$rutaImagen}')";

                // Ejecutar la consulta SQL y verificar si se realizó con éxito
                
                if ($link->query($sql) === TRUE) {
                    echo "<h2>Registro exitoso</h2>";
                    
                    echo "<table style='border-collapse: collapse; width: 100%;'>";
                    echo "<tr style='background-color: #3498db; color: #ffffff;'>";
                    echo "<th style='padding: 10px; text-align: center;'>Nombre</th>";
                    echo "<th style='padding: 10px; text-align: center;'>Marca</th>";
                    echo "<th style='padding: 10px; text-align: center;'>Modelo</th>";
                    echo "<th style='padding: 10px; text-align: center;'>Precio</th>";
                    echo "<th style='padding: 10px; text-align: center;'>Detalles</th>";
                    echo "<th style='padding: 10px; text-align: center;'>Unidades</th>";
                    echo "<th style='padding: 10px; text-align: center;'>Imagen</th>";
                    echo "</tr>";
                    echo "<tr style='background-color: #f2f2f2; text-align: center;'>";
                    echo "<td style='padding: 10px;'>" . $nombre . "</td>";
                    echo "<td style='padding: 10px;'>" . $marca . "</td>";
                    echo "<td style='padding: 10px;'>" . $modelo . "</td>";
                    echo "<td style='padding: 10px;'>" . $precio . "</td>";
                    echo "<td style='padding: 10px;'>" . $detalles . "</td>";
                    echo "<td style='padding: 10px;'>" . $unidades . "</td>";
                    echo "<td style='padding: 10px;'><img src='{$rutaImagen}' alt='Imagen del producto' width='100'></td>";
                    echo "</tr>";
                    echo "</table>";
                } else {
                    echo "Error al registrar el producto en la base de datos: " . $link->error;
                }




                // Cerrar la conexión a la base de datos
                $link->close();
            }
        }
    } else {
        echo "Acceso no autorizado.";
    }
?>



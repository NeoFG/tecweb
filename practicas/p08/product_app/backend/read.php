<?php
    include_once __DIR__.'/database.php';

    // Se crea el arreglo que se va a devolver en forma de JSON
    $data = array();

    // Se verifica haber recibido el término de búsqueda
    if (isset($_POST['searchTerm'])) {
        $searchTerm = $_POST['searchTerm'];
        
        // Se realiza la consulta de búsqueda utilizando la cláusula LIKE
        $query = "SELECT * FROM productos WHERE 
                  nombre LIKE '%$searchTerm%' OR 
                  marca LIKE '%$searchTerm%' OR 
                  detalles LIKE '%$searchTerm%'";

        // Se verifica si la consulta se realizó con éxito
        if ($result = $conexion->query($query)) {
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                // Se codifican a UTF-8 los datos y se añaden al arreglo de respuesta
                $data[] = array_map('utf8_encode', $row);
            }
            $result->free();
        } else {
            die('Query Error: ' . mysqli_error($conexion));
        }
    }
    
    // Se hace la conversión del arreglo a JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>

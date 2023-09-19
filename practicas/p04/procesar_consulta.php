<?php
require_once('parque_vehicular.php'); // Incluye el archivo con el arreglo de vehículos

// Función para consultar la información de un auto por matrícula
    function consultarAutoPorMatricula($matricula) {
        global $parqueVehicular;
        if (isset($parqueVehicular[$matricula])) {
            return $parqueVehicular[$matricula];
        } else {
            return array(); // Devolver un arreglo vacío cuando no se encuentra la matrícula
        }
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["consultar_todos"])) {
            // Consultar todos los autos
            $infoAutos = $parqueVehicular;
        } elseif (isset($_POST["matricula"])) {
            // Consultar por matrícula
            $matricula = strtoupper($_POST["matricula"]);
            $infoAutos = consultarAutoPorMatricula($matricula);
        }    
    // Generar la respuesta en XHTML
        echo "<?xml version='1.0' encoding='UTF-8'?>";
        echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>";
        echo "<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='es' lang='es'>";
        echo "<head>";
        echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />";
        echo "<title>Respuesta de Consulta</title>";
        echo "</head>";
        echo "<body>";
        
        if (is_array($infoAutos)) {
            // Mostrar la información de los autos
            echo "<h2>Información todos los Autos</h2>";
            foreach ($infoAutos as $matricula => $infoAuto) {
                echo "<h3>Matrícula: $matricula</h3>";
                echo "<table border='1'>";
                foreach ($infoAuto as $categoria => $datos) {
                    echo "<tr>";
                    echo "<th>$categoria</th>";
                    if (is_array($datos)) {
                        foreach ($datos as $campo => $valor) {
                            echo "<td>$campo: $valor</td>";
                        }
                    } else {
                        echo "<td>$datos</td>"; // Manejar el caso en el que $datos no es un arreglo
                    }
                    echo "</tr>";
                }
                echo "</table>";
            }
        } else {
            // Manejar el caso en el que $infoAutos no es un arreglo (puede ser un mensaje de error)
            echo "<p>No se encontró información para la matrícula o se produjo un error.</p>";
        }

        // Muestro mi estructura del arreglo dandole formato
        echo "</body>";
        echo "</html>";

        echo ('<h1>Usando el print_r para mostrar la estructura general del arreglo </h1>');
        echo "<pre>";
        print_r($parqueVehicular);
        echo "</pre>";
}
?>

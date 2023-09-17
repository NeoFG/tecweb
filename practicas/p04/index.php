<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 4</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>

    <form method="get" action="index.php">
        <label for="numero">Ingrese un número:</label>
        <input type="number" name="numero" id="numero">
        <input type="submit" value="Verificar">
    </form>

    <?php
        // Incluimos el archivo con la función nos trae todo el php.
        include('eje1.php'); 

        if (isset($_GET['numero'])) {
            $num = $_GET['numero'];
            // Llama a la función con el número que pusimos.
            verificarMultiplo($num); 
        }
    ?>

</body>
</html>

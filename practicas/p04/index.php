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
        require_once('eje1.php'); 

        if (isset($_GET['numero'])) {
            $num = $_GET['numero'];
            // Llama a la función con el número que pusimos.
            verificarMultiplo($num); 
        }
    ?>

    <h2>Ejercicio 2</h2>
    <p>Crea un programa para la generación repetitiva de 3 números aleatorios hasta obtener una secuencia compuesta por: impar, par, impar</p>

    <?php
        // Incluye aquí la función generarSecuencia o asegúrate de que esté disponible
        require_once('eje2.php');

        // Llamamos a la función para generar la secuencia
        $secuenciaGenerada = generarSecuencia();

        // Mostramos la secuencia que fuimos generando
         foreach ($secuenciaGenerada as $secuencia) {
            echo implode(", ", $secuencia) . "<br>";
        }
    ?>

    <h2>Ejercicio 3</h2>
    <p>Punto 1 utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente, pero que además sea múltiplo de un número dado.</p>

    <form method="get" action="index.php">
        <label for="numero_dado">Ingrese un número:</label>
        <input type="number" name="numero_dado" id="numero_dado">
        <input type="submit" value="Verificar">
    </form>

    <?php
        require_once('eje3.php');

        if (isset($_GET['numero_dado'])) {
            $numeroDado = $_GET['numero_dado'];
            // Llama a la función para encontrar el múltiplo
            $multiploEncontrado = encontrarMultiplo($numeroDado);
            echo "Primer número entero múltiplo de $numeroDado encontrado de manera aleatoria es: $multiploEncontrado";
        } else {
            echo "Por favor, proporciona un número dado a través de GET.";
        }
    ?>

    <p>Punto 2 crear una variante de este script utilizando el ciclo do-while.</p>

    <form method="get" action="index.php">
        <label for="numero_dado2">Ingrese un número:</label>
        <input type="number" name="numero_dado2" id="numero_dado2">
        <input type="submit" value="Verificar">
    </form>

    <?php
        require_once('eje3.php');

        if (isset($_GET['numero_dado2'])) {
            $numeroDado = $_GET['numero_dado2'];
            // Llama a la función para encontrar el múltiplo
            $multiploEncontrado = encontrarMultiploConDoWhile($numeroDado);
            echo "Primer número entero múltiplo de $numeroDado encontrado: $multiploEncontrado";
        } else {
            echo "Por favor, proporciona un número dado a través de GET.";
        }
    ?>

    <h2>Ejercicio 4</h2>
    <p>Crear un arreglo cuyos índices van de 97 a 122 y cuyos valores son las letras de la a a la z. Usa la función chr(n) que devuelve el caracter cuyo código ASCII es n para poner el valor en cada índice.</p>

    <?php
        // Incluye la función generarArregloAlfabetico
        require_once('eje4.php');

        // Llama a la función para generar el arreglo
        $arregloAlfabetico = generarArregloAlfabetico();

        // Crea una tabla con los valores del arreglo de mi funcion anterior
        echo '<table border="1">';
        echo '<tr><th>Índice</th><th>Valor</th></tr>';

        foreach ($arregloAlfabetico as $indice => $valor) {
            echo '<tr><td>' . $indice . '</td><td>' . $valor . '</td></tr>';
        }

        echo '</table>';
    ?>

    <h2>Ejercicio 5</h2>
    <p>Usar las variables $edad y $sexo en una instrucción if para identificar una persona de sexo femenino, cuya edad oscile entre los 18 y 35 años y mostrar un mensaje de bienvenida apropiado. Por ejemplo: Bienvenida, usted está en el rango de edad permitido. En caso contrario, deberá devolverse otro mensaje indicando el error.</p>

    <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Obtener los valores de edad y sexo del formulario
            $edad = $_POST["edad"];
            $sexo = $_POST["sexo"];

            // Declaro mi condicion para validar las edades
            if ($sexo === "femenino" && $edad >= 18 && $edad <= 35) {
                $mensaje = "Bienvenida, usted está en el rango de edad permitido.";
            } else {
                $mensaje = "Lo sentimos, no cumple con los criterios de edad y sexo.";
            }

            // Generar la respuesta XHTML
            echo "<!DOCTYPE html>";
            echo "<html lang='es'>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<title>Respuesta</title>";
            echo "</head>";
            echo "<body>";
            echo "<h1>Respuesta</h1>";
            echo "<p>$mensaje</p>";
            echo "</body>";
            echo "</html>";
        }
    ?>
    

</body>
</html>

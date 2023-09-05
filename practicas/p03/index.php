<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.1//EN”
“http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd”>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar, $_7var, myvar, $myvar, $var7, $_element1, $house*5</p>

    <?php
        // Aqui va mi codigo
        $_myvar;
        $_7var;
        // myvar; //Sintaxis invalida
        $myvar;
        $var7;
        $_element1;
        // $house*5; //Sintaxis invalida

        echo '<ul>';
        echo '<li>$_myvar es valida porque inicia con con signo de dolar y un gion</li>';
        echo '<li>$_7var es valida porque inicia con con signo de dolar y un gion</li>';
        echo '<li>myvar es invalida porque no inicia con un signo de $</li>';

        echo '<li>$myvar es valida porque inicia con con signo de dolar y un gion</li>';
        echo '<li>$var7 es valida porque inicia el signo de $</li>';
        echo '<li>$_element1 es valida porque inicia el signo de $</li>';

        echo '<li>$house*5 es invalida porque no se realiza una operacion</li>';
        echo '</ul>';
    ?>
    
</body>
</html>
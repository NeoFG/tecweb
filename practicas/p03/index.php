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
    <h2>Ejercicio 2</h2>
    <p>Proporcionar los valores de $a, $b, $c como sigue:</p>
    <ul>
        <li>$a = "ManejadorSQL";</li>
        <li>$b = 'MySQL';</li>
        <li>$c = &$a;</li>
    </ul>

    <h3>a. Ahora muestra el contenido de cada variable</h3>
    <?php
        $a = "ManejadorSQL";
        $b = 'MySQL';
        $c = &$a;
        echo ("Primer variable: ").$a;
        echo '<br>';
        echo ("Segunda variable: ").$b;
        echo '<br>';

        // Imprimimos el contenido de las variables
        echo ("Tercera variable hace referencia a la primera: ").$c;

        echo '<p>La primier varibale tiene asignada contenido string</p>';

        echo '<p>La segunda varibale tiene asignada contenido string</p>';
        
        echo '<p>La tercera variable tiene asignada la direccion de memoria de memoria de la variable 2 por lo que imprime su contenido string</p>';

        // Cambiamos el contenido de las variables anteriores
        $a = "PHP server";
        $b = &$a; // Ahora hace referencia a la dirreccion de memoria de la var a
        
        echo '<h3>b. Agrega al código actual las siguientes asignaciones:</h3>';
        echo '$a = “PHP server”; $b = &$a;';

        // Parte del ejecicio 2 inciso c
        echo '<h3>c. Vuelve a mostrar el contenido de cada uno </h3>';
        echo ("Contenido modificado de la variable a: ").$a;
        echo '<br>';
        echo ("Contenido modificado de la variable b: ").$b;

        echo '<h3>d. Describe en y muestra en la página obtenida qué ocurrió en el segundo bloque de asignaciones </h3>';
        echo ("Lo que ocurrio fue que a la variable $ a se le cambio el contenido y lo cambiamos a: ").$a;
        echo '<br>';
        echo ("Lo que ocurrio en la variable $ b fue que utilizamos un apuntador hacia la variable b por lo que su contenido cambio al contenido de la variable a: ").$b;
    ?>

    <h2>Ejercicio 3</h2>
    <p>Muestra el contenido de cada variable inmediatamente después de cada asignación, verificar la evolución del tipo de estas variables (imprime todos los componentes de los arreglo)</p>
    <ol>
        <li>$a = "PHP5";    </li>
        <li>$z[] = &$a;     </li>
        <li>$b = "5a version de PHP";</li>
        <li>$c = $b*10;     </li>
        <li>$a .= $b;       </li>
        <li>$b *= $c;       </li>
        <li>$z[0] = "MySQL";</li>
    </ol>
    
    <?php
        $a = "PHP5";
        echo ("El valor y tipo de la variable 1 es: ");
        var_dump($a);
        echo '<br>';

        $z[] = &$a;
        echo ("El valor y tipo de la variable 2 es: ");
        var_dump($z);
        echo '<br>';
        
        $b = "5a version de PHP";
        echo ("El valor y tipo de la variable 3 es: ");
        var_dump($b);
        echo '<br>';

        @$c = $b*10; // Utilizando el @ para suprimir el warning
        echo ("El valor y tipo de la variable 4 es: ");
        var_dump($c);
        echo '<br>';

        $a .= $b;
        echo ("El valor y tipo de la variable 5 es: ");
        var_dump($a);
        echo '<br>';
        
        @$b *= $c;// Utilizando el @ para suprimir el warning
        echo ("El valor y tipo de la variable 6 es: ");
        var_dump($b);
        echo '<br>';

        $z[0] = "MySQL";
        echo ("El valor y tipo de la variable 7 es: ");
        var_dump($z);
        echo '<br>';
    ?>
    
    
</body>
</html>
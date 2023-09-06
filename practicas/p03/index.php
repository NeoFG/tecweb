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
    <p>1.Determina cuál de las siguientes variables son válidas y explica por qué:</p>
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
    <p>2.Proporcionar los valores de $a, $b, $c como sigue:</p>
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
    <p>3.Muestra el contenido de cada variable inmediatamente después de cada asignación, verificar la evolución del tipo de estas variables (imprime todos los componentes de los arreglo)</p>
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

    <h2>Ejercicio 4</h2>
    <p>4. Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de la matriz $GLOBALS o del modificador global de PHP.</p>

    <?php
        // Utilizando $GLOBALS

        $a = "PHP5";
        echo "\$GLOBALS['a'] = " . $GLOBALS['a'] . "<br>";

        $z[] = &$a;
        echo "\$GLOBALS['z'][0] = " . $GLOBALS['z'][0] . "<br>";

        $b = "5a version de PHP";
        echo "\$GLOBALS['b'] = " . $GLOBALS['b'] . "<br>";

        @$c = $b * 10;
        echo "\$GLOBALS['c'] = " . $GLOBALS['c'] . "<br>";

        $a .= $b;
        echo "\$GLOBALS['a'] = " . $GLOBALS['a'] . "<br>";

        $b *= $c;
        echo "\$GLOBALS['b'] = " . $GLOBALS['b'] . "<br>";

        $z[0] = "MySQL";
        echo "\$GLOBALS['z'] = " . print_r($GLOBALS['z'], true) . "<br>";
    ?>
    
    <h2>5. Dar el valor de las variables $a, $b, $c al final del siguiente script:</h2>
    <ol>
        <li>$a = "7 personas";</li>
        <li>$b = (integer) $a;</li>
        <li>$a = “9E3”;</li>
        <li>$c = (double) $a;</li>
    </ol>

    <?php
        $a = "7 personas";
        $b = (integer) $a;
        $a = "9E3";
        $c = (double) $a;

        echo "\$a = " . $a . " su valor original es un string pero al hacerle un casteo de integer lo volvemos un entero <br>";
        
        echo "\$b = " . $b . " ya que lo volvemos un apuntador toma el valor de la variable \$a <br>";
        
        echo "\$c = " . $c . " le asignamos el valor casteado de la variable \$a por eso su valor es el mismo.<br>";
    ?>

    <h2>6. Dar y comprobar el valor booleano de las variables $a $b, $c, $d, $e y $f y muéstralas usando la función var_dump(datos).</h2>

    <ol>
        <li>$a = "0";</li>
        <li>$b = "TRUE";</li>
        <li>$c = FALSE;</li>
        <li>$d = ($a OR $b);</li>
        <li>$e = ($a AND $c);</li>
        <li>$f = ($a XOR $b);</li>
    </ol>

    <?php
        $a = "0";
        echo ("El valor y tipo de la variable \$a es: ");
        var_dump($a);
        echo '<br>';

        $b = "TRUE";
        echo ("El valor y tipo de la variable \$b es: ");
        var_dump($b);
        echo '<br>';
        
        $c = FALSE;
        echo ("El valor y tipo de la variable \$c es: ");
        var_dump($c);
        echo '<br>';
        
        $d = ($a OR $b);
        echo ("Ya que \$a es falso y un string y \$b es un string que dice verdad y ninguna cumple la variable \$d es: ");
        var_dump($d);
        echo '<br>';

        $e = ($a AND $c);
        echo ("Ya que \$a es falso y \$c falso \$e es: ");
        var_dump($e);
        echo '<br>';
        
        $f = ($a XOR $b); // exclusiva OR
        echo ("El valor de la exclusiva OR de la variable \$a y la variable \$b asignada a la varible \$f es: ");
        var_dump($f);
        echo '<br>';
    ?>

    <h3>Después investiga una función de PHP que permita transformar el valor booleano de $c y $e en uno que se pueda mostrar con un echo: </h3>

    <?php 
        $a = "0";
        $b = "TRUE";
        $c = FALSE;
        $d = ($a OR $b);
        $e = ($a AND $c);
        $f = ($a XOR $b);

        echo ("La funcion var_export() puede utilizarse para transformar el valor booleano de las variables en una representación que se pueda mostrar. <br>");
        
        echo "\$c = " . var_export($c, true) . "<br>";
        echo "\$e = " . var_export($e, true) . "<br>";
    ?>

    <h3>Usando la variable predefinida $_SERVER, determina lo siguiente:</h3>
    <ul>
        <li>La versión de Apache y PHP</li>
        <li>El nombre del sistema operativo (servidor)</li>
        <li>El idioma del navegador (cliente)</li>
    </ul>

    <?php
        // La versión de Apache y PHP
        $apacheVersion = $_SERVER['SERVER_SOFTWARE'];
        $phpVersion = phpversion();
        
        echo "Versión de Apache: $apacheVersion<br>";
        echo "Versión de PHP: $phpVersion<br>";
        
        // El nombre del sistema operativo (servidor)
        $serverOS = $_SERVER['SERVER_SOFTWARE'];
        echo "Sistema Operativo del Servidor: $serverOS<br>";
        
        // El idioma del navegador (cliente)
        $clientLanguage = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        echo "Idioma del Navegador del Cliente: $clientLanguage<br>";
    ?>

</body>
</html>
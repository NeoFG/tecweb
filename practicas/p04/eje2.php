<?php
    function generarSecuencia() {
        $secuencias = array(); // Inicializamos un array para almacenar las secuencias

        while (count($secuencias) < 3) { // Mi es mi numero de iteraciones y lo que se va ir guardando en mi array
            $secuencia = array(); // Inicializamos un array para cada secuencia
            while (true) {
                // Generamos tres números aleatorios
                $numero1 = rand(1, 100); // Generar un número aleatorio entre 1 y 100
                $numero2 = rand(1, 100);
                $numero3 = rand(1, 100);

                // Comprobamos si los números generados forman la secuencia deseada: impar, par, impar
                if ($numero1 % 2 == 1 && $numero2 % 2 == 0 && $numero3 % 2 == 1) {
                    // Si la secuencia es correcta, la almacenamos en la matriz
                    $secuencia[] = $numero1;
                    $secuencia[] = $numero2;
                    $secuencia[] = $numero3;
                    break;
                }
            }
            $secuencias[] = $secuencia; // Agregamos la secuencia a la matriz de secuencias
        }

        return $secuencias;
        // regresa mi matrix 
    }
?>

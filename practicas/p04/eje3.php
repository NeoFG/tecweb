<?php
    function encontrarMultiplo($numeroDado) {
        $numeroAleatorio = 0;

        while (true) {
            // Con rand es el rango de mi var aleatoria.
            $numeroAleatorio = rand(1, 100); 
            

            if ($numeroAleatorio % $numeroDado == 0) {
                break;
            }
        }

        return $numeroAleatorio;
    }

    // Esta es mi segunda funcion del punto 2 del eje3

    function encontrarMultiploConDoWhile($numeroDado) {
        $numeroAleatorio = 0;

        do {
            $numeroAleatorio = rand(1, 100); 

        } while ($numeroAleatorio % $numeroDado != 0);

        return $numeroAleatorio;
    }
?>
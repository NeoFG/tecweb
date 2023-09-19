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
?>
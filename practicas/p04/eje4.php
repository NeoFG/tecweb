<?php
    function generarArregloAlfabetico() {
        // Creo un var y le asigno un arry 
        $arreglo = array();
        // Le doy un rango
        for ($i = 97; $i <= 122; $i++) {
            // utilizo el metodo chr para castear los valores.
            $arreglo[$i] = chr($i);
        }
        return $arreglo;
    }
?>

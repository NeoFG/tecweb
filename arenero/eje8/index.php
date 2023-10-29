<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once __DIR__ . '/Operacion.php';
        $sum1 = new Suma;
        $sum1->setValor(10);
        $sum1->setValor2(5);
        $sum1->operar();
        echo '<br>';
        echo '10 + 5 = '. $sum1->getResultado();

        $res1 = new Resta;
        $res1->setValor(10);
        $res1->setValor2(5);
        $res1->operar();
        echo '<br>';
        echo '10 - 5 = '. $res1->getResultado();


        $mul1 = new Multiplicacion;
        $mul1->setValor(10);
        $mul1->setValor2(5);
        $mul1->operar();
        echo '<br>';
        echo '10 * 5 = '. $mul1->getResultado();

        $div1 = new Divicion;
        $div1->setValor(10);
        $div1->setValor2(5);
        $div1->operar();
        echo '<br>';
        echo '10 / 5 = '. $div1->getResultado();
        
    ?>
</body>
</html>
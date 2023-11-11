<?php
    // Hay que cambiar las rutas de los archivos para 
    //posteriormente ponerlo con una variable y el new
   
    //use Webtechnologies\Models\User as User;

    // composer dump-autoload -o

    use Webtechnologies\Config\Dev as Dev;

    require_once __DIR__ . '/app/start.php';
    
    $user = new Dev();
    //$user = new UserTemplate();
    //$user = new UserController();
?>
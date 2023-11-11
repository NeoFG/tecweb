<?php
    // Hay que cambiar las rutas de los archivos para 
    //posteriormente ponerlo con una variable y el new
   
    //use Webtechnologies\Models\User as User;

    use Webtechnologies\Views\AccountTemplate as AccountTemplate;
      
    require_once __DIR__ . '/app/start.php';
    
    $user = new AccountTemplate();
    //$user = new UserTemplate();
    //$user = new UserController();
?>
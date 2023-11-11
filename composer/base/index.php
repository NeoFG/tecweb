<?php
    require_once __DIR__ . '/app/models/User.php';
    require_once __DIR__ . '/app/models/Account.php';
    require_once __DIR__ . '/app/views/UserTemplate.php';
    require_once __DIR__ . '/app/views/AccountTemplate.php';
    require_once __DIR__ . '/app/controllers/UserController.php';
    require_once __DIR__ .'./app/controllers/AccountController.php';

    $user = new AccountController  ();
    //$user = new UserTemplate();
    //$user = new UserController();
?>
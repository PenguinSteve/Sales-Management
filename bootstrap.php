<?php
    define('_DIR_ROOT', __DIR__);
    require_once('./configs/routes.php');
    require_once('./app/core/Connection.php');
    require_once('./app/core/Database.php');
    require_once('./app/App.php');
    require_once('./app/core/Controller.php');
    $myApp = new App();
?>
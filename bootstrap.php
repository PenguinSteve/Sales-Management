<?php
    define('_DIR_ROOT', __DIR__);
    define('_HOST', "http://localhost/Sales-Management/"); //change the text after "localhost/" match with folder name in htdocs
    require_once('./configs/routes.php');
    require_once('./app/core/Connection.php');
    require_once('./app/core/Database.php');
    require_once('./app/App.php');
    require_once('./app/core/Controller.php');
    $myApp = new App();
?>
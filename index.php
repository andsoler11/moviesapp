<?php

// i put all the errors and error_log on a file call php-error.log so i can see better the errors log
    error_reporting(E_ALL);

    ini_set('ignore_repeated_errores', TRUE);

    ini_set('display_errors', FALSE);

    ini_set('log_errors', TRUE);


    ini_set("error_log", "C:/xampp/htdocs/webAppAndresSoler/php-error.log");
    error_log('Inicio app web');




    require_once 'libs/database.php';
    require_once 'classes/errormessages.php';
    require_once 'classes/successmessages.php';


    require_once 'libs/controller.php';
    require_once 'libs/model.php';
    require_once 'libs/view.php';
    require_once 'libs/app.php';

    require_once 'config/config.php';


    $app = new App();

?>
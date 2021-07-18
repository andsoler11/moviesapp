<?php

/**
 * this class is to show the errors if the app doesnt find the parameter that the user put
 */

class Errors extends Controller
{
    function __construct()
    {
        parent::__construct();
        error_log('Erros::construct -> inicio de Errors');
    }

    function render()
    {
        $this->view->render('errors/index');
    }
}


?>
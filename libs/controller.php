<?php

/**
 * this is the controller class
 * from this class the other controllers are going to extend
 * im going to use it to load the models
 * redirect to another view passing messages
 * and also did a function to get POST calls from my forms in the views so i dont have to wirte always like $_POST 
 */


class Controller
{
    function __construct()
    {
        $this->view = new View();
    }

    function loadModel($model)
    {
        $url = 'models/' . $model . 'model.php';

        if(file_exists($url))
        {
            require_once $url;
            $modelName = $model.'Model';
            $this->model = new $modelName();
        }
    }

    function existPost($params)
    {
        foreach ($params as $param)
        {
            if(!isset($_POST[$param])){
                error_log('CONTROLLER::existPost -> no existe el parametro ' . $param);
                return false;
            }
        }

        return true;
    }

    function existGet($params)
    {
        foreach ($params as $param)
        {
            if(!isset($_GET[$param])){
                error_log('CONTROLLER::existGet -> no existe el parametro ' . $param);
                return false;
            }
        }
        
        return true;
    }

    function getGet($name)
    {
        return $_GET[$name];
    }

    function getPost($name)
    {
        return $_POST[$name];
    }

    function redirect($route, $messages)
    {
        $data = [];
        $params = '';

        foreach($messages as $key => $message)
        {
            array_push($data, $key . '=' . $message);
        }

        $params = join('&', $data);
        //?nombre=Andres&apellido=Soler

        if($params != '')
        {
            $params = '?' . $params;
        }

        header('location: ' . constant('URL') . '/' . $route . $params);
    }


}


?>
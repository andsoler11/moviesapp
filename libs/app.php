<?php

    require_once "controllers/errors.php";

    class App 
    {
          function __construct()
          {
              $url = isset($_GET['url']) ? $_GET['url'] : null;
              $url = rtrim($url, '/');
              $url = explode('/', $url);


              // here is the default view that im going to send if there is no methods
              if(empty($url[0]))
              {
                error_log('APP::contruct-> no hay controlador especificado');
                $fileController = 'controllers/signup.php';
                require $fileController;
                $controller = new Signup();
                $controller->loadModel('signup');
                $controller->render();
                return false;
              }

              //here i bring the specified controller
              $fileController = 'controllers/' . $url[0] . '.php';

              if(file_exists($fileController)){
                require_once $fileController;

                $controller = new $url[0];
                $controller->loadModel($url[0]);

                if(isset($url[1])){
                    if(method_exists($controller, $url[1])){
                        if(isset($url[2])){
                            // number of parameters
                            $nparam = count($url) - 2;
                            // array of parameters
                            $params = [];

                            for ($i=0; $i < $nparam; $i++) { 
                                array_push($params, $url[$i] + 2);
                            }

                            $controller->{$url[1]}($params);

                        } else {
                            // if there is no parameters, we are going to call the method 
                            $controller->{$url[1]}();
                        }
                    } else {
                        // error, there is no method
                        $controller = new Errors();
                        $controller->render();
                    }

                } else {
                    //if there is no method, it will charge a default method;
                    $controller->render();
                }
              } else {
                // there is no file, show error;

                $controller = new Errors();
                $controller->render();
              }


          }  
    }

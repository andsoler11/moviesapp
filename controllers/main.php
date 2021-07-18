<?php

/**
 * in this class i use it to controll all the information that the main view must have
 * so i conect the database to bring, update the data
 * and show it on the main view
 */
class Main extends Controller
{
    function __construct()
    {
        parent::__construct();
        error_log('Main::contruct -> inicio de Main');
    }


    function render()
    {
        error_log('Main::render -> carga el index del Main');
        $this->view->render('main/index');
    } 

    function updateMovies()
    {
        $data = $this->model->consumeAPI('https://www.omdbapi.com/?s=avengers&apiKey=fc59da33');      
        $database = new Database();
        $database->name = '/json/movies.json';
        $arrayData = $database->bringData($database->name);
        $jsonTitles = [];
        foreach($arrayData as $jsonData){
            array_push($jsonTitles, $jsonData['Title']);
        } 
        $apiTitles = [];
        foreach($data as $movie){
            array_push($apiTitles, $movie['Title']);
        }        
        $newMovies =  array_diff($apiTitles, $jsonTitles);      
        if(sizeof($newMovies) > 0){
            $extra = [];
            foreach($data as $movie){
                if(in_array($movie['Title'], $newMovies)){
                    array_push($extra, $movie);
                }
            }
            $array_data[] = $extra;
            $messageOk = $database->sendData($database->name, $data);
            if($messageOk){
                $this->redirect('main', ['success' => SuccessMessages::SUCCESS_MAIN_UPDATE]);
            }
        }
        $this->redirect('main', ['success' => SuccessMessages::SUCCESS_MAIN_UPDATE]);

    }


    function logout()
    {
        $this->model->logout();
        $this->redirect('login', ['success' => SuccessMessages::SUCCESS_MAIN_LOGOUT]);
    }


    function filterMovies()
    {

        if($this->existPost(['search', 'fromYear', 'toYear'])){
            $search = $this->getPost('search');           
            $fromYear = $this->getPost('fromYear');
            $toYear = $this->getPost('toYear');
        

            $search = strtolower($search);
            $database = new Database();
            $database->name = '/json/movies.json';
            $arrayData = $database->bringData($database->name);
            $movies = [];
            if($search != null){
                foreach($arrayData as $movie){
                    $title = strtolower($movie['Title']);
                    $title = lcfirst($title);
                    if(strpos($title, $search)){
                        array_push($movies, $movie);
                    }
                }
            }
            $moviesFiltered = [];
            if($fromYear != null && $toYear != null){
                foreach($movies as $movieFilter){
                    if(intval($movieFilter['Year']) >= $fromYear && intval($movieFilter['Year']) <= $toYear){
                        array_push($moviesFiltered, $movieFilter);
                    }                
                }
                $movies = $moviesFiltered;
            }
            if($search == null){
                foreach($arrayData as $movie){
                    if(intval($movie['Year']) >= $fromYear && intval($movie['Year']) <= $toYear){
                        array_push($movies, $movie);
                    }                
                }
            }
            if(count($movies) == 0){
                $message = 'There is no movies matching your search';
            }
            if($search ==null && $fromYear==null  && $toYear==null){
                $message = 'please search something, or update the list';
            }

            return $movies;
        }
    }


}


?>
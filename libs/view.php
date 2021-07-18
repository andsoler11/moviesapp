<?php



/**
 * in this class i use it to show the data to the user
 * i pass the error messages or succes messages
 * and also i pass the data that i bring from the database
 */

class View
{
    function __construct()
    {
        
    }

    function render($name, $data = [])
    {
        $this->d = $data;

        $this->handleMessages();

        require 'views/' . $name . '.php';
    }

    private function handleMessages()
    {
        if(isset($_GET['success']) && isset($_GET['error']))
        {
            //error
        } 
        else if(isset($_GET['success']))
        {
            $this->handleSuccess();
        }
        else if(isset($_GET['error']))
        {
            $this->handleError();
        }
    }

    private function handleError()
    {
        $hash = $_GET['error'];
        $error = new ErrorMessages();

        if($error->existsKey($hash))
        {
            $this->d['error'] = $error->get($hash);
        }
    }

    private function handleSuccess()
    {
        $hash = $_GET['success'];
        $success = new SuccessMessages();

        if($success->existsKey($hash))
        {
            $this->d['success'] = $success->get($hash);
        }
    }


    public function showMessages()
    {
        $this->showErrors();
        $this->showSuccess();

    }

    public function showErrors()
    {
        if(array_key_exists('error', $this->d))
        {
            echo '<div class="error-txt">' . $this->d['error'] . '</div>';
        }
    }

    public function showSuccess()
    {
        if(array_key_exists('success', $this->d))
        {
            echo '<div class="good-txt">' . $this->d['success'] . '</div>';
        }
    }

    public function showData()
    {
        $main = new MainModel;
        $data = $main->bringDatabase();
        $movies = new Main;
        $movies = $movies->filterMovies();
        if(!$movies)
        {   
            $output = '';

            foreach($data as $movie){

            $output .= '<div class="movie">
                        <div class="movie-title">'. $movie['Title'] . '</div>
                        <div class="movie-year">' . $movie['Year'] . '</div>
                        <div class="movie-type">' . $movie['Type'] . '</div>
                        <div class="movie-poster"><img src="' . $movie['Poster'] . '" alt=""></div>
                      </div>';
            }
        } 
        else 
        {
            $output = '';

            foreach($movies as $movie){

            $output .= '<div class="movie">
                        <div class="movie-title">'. $movie['Title'] . '</div>
                        <div class="movie-year">' . $movie['Year'] . '</div>
                        <div class="movie-type">' . $movie['Type'] . '</div>
                        <div class="movie-poster"><img src="' . $movie['Poster'] . '" alt=""></div>
                      </div>';
            }
        }

        echo $output;

    }

}


?>
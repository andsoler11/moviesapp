<?php


/**
 * here is the main model class, in this class i cosume the API, logout from the session and also bring the data from the database so i can show it
 */



class MainModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }
    // this function is to consume the API url that i pass it on the controller
    public function consumeAPI($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($data, true);
        $data = $data['Search'];
        return $data;                
    }

    // to logout from the current session
    public function logout()
    {
        session_destroy();               
    }

    // bring the data so i can show it on my views
    public function bringDatabase()
    {
        $database = new Database();
        $database->name = '/json/movies.json';
        $arrayData = $database->bringData($database->name);
        return $arrayData;
    }



}



?>
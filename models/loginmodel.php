<?php

/**
 * in this class i validate the login, if the password and email is correct
 */



class LoginModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function login($username, $password)
    {
        $database = new Database();
        $database->name = '/json/users.json';
        $array_data = $database->bringData($database->name);
        $final = false;
        foreach ($array_data as $data){
            if($username == $data['username'] && $password == $data['password']){
                $final = true;
            }
        }
        return $final;                
    }
}



?>
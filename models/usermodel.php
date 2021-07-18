<?php

/**
 * in this classs i put functions to validate usernames o emails
 * also to send the user data to the database
 * get the data from the database
 * and also just to get 1 user from the database
 * i put more functions that the ones that i used in the app because i started with this class and i thought i was going to use them
 */

class UserModel extends Model
{
    public $id;
    public $username;
    public $email;
    public $phone;
    public $password;
        
    public function __construct($id, $username, $email, $phone, $password)
    {
        parent::__construct();
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;

    }

    // send the data to the database using the parameters needed
    public function send($id, $username, $email, $phone, $password)
    {
        $database = new Database();
        $database->name = '/json/users.json';
        $array_data = $database->bringData($database->name);
        $extra = (array) new UserModel($id, $username, $email, $phone, $password);
        $array_data[] = $extra;
        $message_interno = $database->sendData($database->name, $array_data);
        error_log('UserModel::send --> enviando informacion al archivo json');
        if(isset($message_interno)){
            return true;
        } else {
            return false;
        }
        
    }
    // validate if the username alredy exists in the database
    public function existsUsername($username)
    {
        $database = new Database();
        $database->name = '/json/users.json';
        $array_data = $database->bringData($database->name);
        foreach ($array_data as $data){
            if($username == $data['username']){
                return 'That username alredy exists';
            }
        }
    }
    // validate if the email exists in the database
    public function existsEmail($email)
    {
        $database = new Database();
        $database->name = '/json/users.json';
        $array_data = $database->bringData($database->name);
        foreach ($array_data as $data){
            if($email == $data['email']){
                return 'That email alredy exists';
            }
        }
    }
    // get all the data from the users database
    public function getAll()
    {
        $database = new Database();
        $database->name = '/json/users.json';
        $array_data = $database->bringData($database->name);
        $users = [];
        $arraySize = sizeof($array_data);
        for ($i=0; $i < $arraySize; $i++) { 
                array_push($users, $array_data[$i]);
        }
        return $users;
    }

    // get an specific user form the database
    public function get($id)
    {
        $database = new Database();
        $database->name = '/json/users.json';
        $array_data = $database->bringData($database->name);
        //$users = [];
        //$userData = [];
        $arraySize = sizeof($array_data);
        for ($i=0; $i < $arraySize; $i++) { 
            if($array_data[$i]['id'] == $id){
                $userData = $array_data[$i];
            }
        }
        return $userData;
    }

   
}


?>
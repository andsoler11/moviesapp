<?php

/**
 * this class is the one that i use instead of conecting to a normal database
 * i use this passing a route like $name, so i use it to get to the json file
 * and also to send the data to the json file
 */
class Database
{

    public $name;
    
    public function bringData($name)
    {
        if (file_exists(__DIR__ . $name)) {
            $current_data = file_get_contents(__DIR__ . $name);
            $array_data = json_decode($current_data, true);
            return $array_data;
        } else {
            return 'There is no Database';
        }
    }

    public function sendData($name, $array_data)
    {
        $final_data = json_encode($array_data);
        if (file_put_contents(__DIR__ . $name, $final_data)) {
            return true;
        }
    }
}
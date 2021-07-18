<?php


/**
 * in this class i put the errors, assigning them a random number so the whole message is not show on the url
 * i also show this errors on the views so the user can see what is happening
 */

class ErrorMessages
{
    const PRUEBA = "1";
    const ERROR_SIGNUP_NEWUSER = '12';
    const ERROR_SIGNUP_NEWUSER_EMPTY = '123';
    const ERROR_SIGNUP_EMAIL_EXISTS  = '1234';
    const ERROR_SIGNUP_EMAIL_INVALID = '12345';
    const ERROR_SIGNUP_USERNAME_EXISTS = '123456';
    const ERROR_LOGIN_AUTHENTICATE_EMPTY = '1234567';
    const ERROR_LOGIN_AUTHETICATE_DATA = '2';
    const ERROR_LOGIN_AUTHETICATE = '3';
    const ERROR_SIGNUP_NEWUSER_USERNAME = '4';
    const ERROR_SIGNUP_NEWUSER_PHONE = '5';
    CONST ERROR_SIGNUP_NEWUSER_PASSWORD = '6';


    private $errorList = [];

    public function __construct()
    {
        $this->errorList = [
            ErrorMessages::PRUEBA => 'ESTE ES UN EJEMPLO DE ERROR',
            ErrorMessages::ERROR_SIGNUP_NEWUSER => 'Hubo un error al intentar procesar la solicitud',
            ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY => 'Porfavor pon un usuario y contrasenia',
            ErrorMessages::ERROR_SIGNUP_USERNAME_EXISTS => 'That email alredy exists',
            ErrorMessages::ERROR_SIGNUP_EMAIL_EXISTS => 'That email alredy exists',
            ErrorMessages::ERROR_SIGNUP_EMAIL_INVALID => 'Please enter a valid email',
            ErrorMessages::ERROR_LOGIN_AUTHENTICATE_EMPTY => 'please complete the username and password fields',
            ErrorMessages::ERROR_LOGIN_AUTHETICATE_DATA => 'Invalid username or password',
            ErrorMessages::ERROR_LOGIN_AUTHETICATE => 'something went wrong',
            ErrorMessages::ERROR_SIGNUP_NEWUSER_USERNAME => 'The username must only have letters',
            ErrorMessages::ERROR_SIGNUP_NEWUSER_PHONE => 'the phone number can only have 9 numbers, and start with the sign "+"',
            ErrorMessages::ERROR_SIGNUP_NEWUSER_PASSWORD => 'the password must be 6 digits length and have 1 uppercase and "*", "-", "."',





        ];
    }


    public function get($hash)
    {
        return $this->errorList[$hash];    
    }


    public function existsKey($key)
    {
        if(array_key_exists($key, $this->errorList))
        {
            return true;
        } else {
            return false;
        }
    }
}



?>
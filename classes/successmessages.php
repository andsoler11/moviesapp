<?php


/**
 * in this class i put the succesfull messages
 * so the message is going to go to the view that it redirrects
 */

class SuccessMessages
{

    const PRUEBA = "1";
    const SUCCESS_NEWUSER = '12';
    const SUCCESS_LOGIN = '123';
    const SUCCESS_MAIN_UPDATE = '1234';
    const SUCCESS_MAIN_LOGOUT = '12345';

    private $successList = [];

    public function __construct()
    {
        $this->successList = [
            SuccessMessages::PRUEBA => 'ESTE ES UN MENSAJE DE EXITO',
            SuccessMessages::SUCCESS_NEWUSER => 'New user created',
            SuccessMessages::SUCCESS_LOGIN => 'Logged on',
            SuccessMessages::SUCCESS_MAIN_UPDATE => 'List updated',
            SuccessMessages::SUCCESS_MAIN_LOGOUT => 'logged off',

        ];
    }

    public function get($hash)
    {
        return $this->successList[$hash];    
    }


    public function existsKey($key)
    {
        if(array_key_exists($key, $this->successList))
        {
            return true;
        } else {
            return false;
        }
    }
}



?>
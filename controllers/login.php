<?php



/**
 * here i use the authenticate method to validate if the username and passowerd is correct i do 
 * the session_start() so the user is going to be logged in
 */


class Login extends Controller
{
    function __construct()
    {
        parent::__construct();
        error_log('Login::contruct -> inicio de login');
    }


    function render()
    {
        error_log('Login::render -> carga el index del login');
        $this->view->render('login/index', []);
    }

    function authenticate()
    {
        if($this->existPost(['username', 'password'])){
            $username = $this->getPost('username');
            $password = $this->getPost('password'); 
            if($username == '' || empty($username) || $password == '' || empty($password)){
                $this->redirect('login', ['error' => ErrorMessages::ERROR_LOGIN_AUTHENTICATE_EMPTY]);
            }  
            $user = $this->model->login($username, $password);
            if($user){
                session_start();
                
                $this->redirect('main', ['success' => SuccessMessages::SUCCESS_LOGIN]);

            } else {
                $this->redirect('login', ['error' => ErrorMessages::ERROR_LOGIN_AUTHETICATE_DATA]);
            }
        } else {
            $this->redirect('login', ['error' => ErrorMessages::ERROR_LOGIN_AUTHETICATE]);
        }  
    }

}


?>
<?php


require_once "models/usermodel.php";

/**
 * here i have this class so i can put new users into the users database
 * and also validate all the steps to get to a good user data
 */

class Signup extends Controller
{
    function __construct()
    {
        parent::__construct();
        error_log('Signup::contruct -> inicio de signup');
    }


    function render()
    {
        error_log('Signup::render -> carga el index del Signup');
        $this->view->render('signup/index', []);
    }


    function newUser()
    {
        if($this->existPost(['username', 'password'])){
            //first i get the information that the user put on the form
            $username = $this->getPost('username');           
            $email = $this->getPost('email');
            $phone = $this->getPost('phone');
            $password = $this->getPost('password');
            $id = rand(time(), 10000000);
            // i validate that the info is not empty
            if($username == '' || empty($username) || $password == '' || empty($password)){
                $this->redirect('signup', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY]);
            }        
            // i create a new user with the data so i can put it on the database   
            $user = new UserModel($id, $username, $email, $phone, $password); 
            //validate that the username only contains letters                  
            if(preg_match("/^[a-zA-Z]+$/", $username)){
                // validate that the email is a valid email, using FILTER_VALIDATE_EMAIL
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    //validate that the phone number has 9 numbers and start with a "+"
                    if(preg_match("/(\+)([0-9][ -]*){9}/", $phone)){
                        //validate that the password must have 1 upper case 1 lower case, an "-", an "." and a "*"
                        if(preg_match("/^(?=.*\*)(?=.*\-)(?=.*\.)(?=.*[A-Z])(?=.*[a-z])\S{6}$/", $password)){
                            // i validate that the username dont exists in the database by calling the method existsUsername from usermodel
                            $messageOk = $user->existsUsername($username);
                            if(!isset($messageOk)){
                                // validate that the email dont exists in the database by calling the method existsEmail from usermodel
                                $messageOk = $user->existsEmail($email);
                                if(!isset($messageOk)){
                                    // send the data to the database
                                    $messageOk = $user->send($id, $username, $email, $phone, $password);
                                    if($messageOk){
                                        // i redirect again to login but with a success message
                                        $this->redirect('login', ['success' => SuccessMessages::SUCCESS_NEWUSER]);
                                    }
                                } else {
                                    $this->redirect('signup', ['error' => ErrorMessages::ERROR_SIGNUP_EMAIL_EXISTS]);
                                }
                            } else {
                                $this->redirect('signup', ['error' => ErrorMessages::ERROR_SIGNUP_EMAIL_EXISTS]);
                            }
                        } else {
                            $this->redirect('signup', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_PASSWORD]);
                        }
                    } else {
                        $this->redirect('signup', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_PHONE]);
                    }
                } else {
                    $this->redirect('signup', ['error' => ErrorMessages::ERROR_SIGNUP_EMAIL_INVALID]);
                }
            } else {
                $this->redirect('signup', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_USERNAME]);
            } 
        }
        else {
            $this->redirect('signup', ['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER]);
        }
    }
}


?>
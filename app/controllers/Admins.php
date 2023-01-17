<?php
class Admins extends Controller
{
    private $adminModel;
    public function __construct()

    {
        $this->adminModel = $this->model('Admin');
    }
  

    public function loginAdmin()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // die('test');
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => ''
            ];
            // check eamil
            if (empty($data['email'])) {
                $data['email_err'] = 'please enter email';
            }else{
                // check email if exist in DB
            if ($this->adminModel->findUserByEmail($data['email'])) {
                // user is found
            } else {
                $data['email_err'] = 'this account is not exist';
            }
            }


            
            if (empty($data['password'])) {
                $data['password_err'] = 'please enter password';
            }


            


            // errores are empty
            if (empty($data['password_err']) && empty($data['email_err'])) {
                // for validate email and password
                $loggedInUser = $this->adminModel->login($data['email'], $data['password']);
                if ($loggedInUser) {
                    // success
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'password incorrect';
                    $this->view('Admins/loginAdmin', $data);
                }
            } else {
                $this->view('Admins/loginAdmin', $data);
            }
        } else {
            // die('alert');
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];
            // affiche la page de register 
            $this->view('Admins/loginAdmin', $data);
        }
    }




    //create a methode separeted for login
    public function createUserSession($user){
        $_SESSION['user_id'] = $user->Id_client;
        $_SESSION['user_name'] = $user->Name;
        $_SESSION['user_email'] = $user->email;
        header('location:' . URLROOT . '/Dashboard/Dashboard');
    }

    // create a methof for log out
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        session_destroy();
        header('location:' . URLROOT . '/users/login');
    }


    
}

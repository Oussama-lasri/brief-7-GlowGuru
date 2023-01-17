<?php
class Users extends Controller
{
    private $userModel;
    public function __construct()

    {
        $this->userModel = $this->model('User');
    }
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'name' => trim($_POST['name']),
                'Phone_Number' => trim($_POST['Phone_Number']),
                'Adresse' => trim($_POST['Adresse']),
                'ville' => trim($_POST['ville']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'Phone_Number_err' => '',
                'Adresse_err' => '',
                'ville_err' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            // check data 
            // check name 
            if (empty($data['name'])) {
                $data['name_err'] = 'please enter name ';
            }
            // check Phone Number
            if (empty($data['Phone_Number'])) {
                $data['Phone_Number_err'] = 'please enter Phone Number ';
            }
            // check Adresse
            if (empty($data['Adresse'])) {
                $data['Adresse_err'] = 'please enter Adresse ';
            }
            // check Ville
            if (empty($data['ville'])) {
                $data['ville_err'] = 'please enter ville ';
            }
            // check email
            if (empty($data['email'])) {
                $data['email_err'] = 'please enter email ';
            } else {
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'email is already taken';
                }
            }


            if (empty($data['password'])) {
                $data['password_err'] = 'please enter password ';
            } elseif (strlen($data['password'] < 6)) {
                $data['password_err'] = 'password is must be at least 6 caracters';
            }



            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'please enter confirm password ';
            } else {
                if ($data['confirm_password'] != $data['password']) {
                    $data['confirm_password_err'] = 'password doesn t mutch ';
                }
            }


            if (empty($data['email_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                //validate
                // hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                // register User
                if ($this->userModel->register($data)) {
                    flash('register_success', 'you are registered and can log in', 'alert alert-success');
                    header('location:' . URLROOT . '/users/login');
                } else {
                    die('something went wrong');
                }
            } else {
                $this->view('users/register', $data);
            }
        } else {
            $data = [
                'name' =>'',
                'Phone_Number' => '',
                'Adresse' => '',
                'ville' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'Phone_Number_err' => '',
                'Adresse_err' => '',
                'ville_err' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            // affiche la page de register 
            $this->view('users/register', $data);
        }
    }

    public function login()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
            if ($this->userModel->findUserByEmail($data['email'])) {
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
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                if ($loggedInUser) {
                    // success
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'password incorrect';
                    $this->view('users/login', $data);
                }
            } else {
                $this->view('users/login', $data);
            }
        } else {
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];
            // affiche la page de register 
            $this->view('users/login', $data);
        }
    }




    //create a methode separeted for login
    public function createUserSession($user){
        $_SESSION['user_id'] = $user->Id_client;
        $_SESSION['user_name'] = $user->Name;
        $_SESSION['user_email'] = $user->email;
        header('location:' . URLROOT . '/pages/index');
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

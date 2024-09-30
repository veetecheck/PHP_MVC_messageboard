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
        // check for POST method
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // process form

            // sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // init data
            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'username_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email.';
            } else {
                // check email
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already taken.';
                }
            }
            // validate username
            if (empty($data['username'])) {
                $data['username_err'] = 'Please enter username.';
            } else {
                // check email
                if ($this->userModel->findUserByUsername($data['username'])) {
                    $data['username_err'] = 'Username is already taken.';
                }
            }
            // validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password.';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters.';
            }
            // validate confirm_password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password.';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match.';
                }
            }

            // make sure errors are empty
            if (empty($data['username_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // validated
                // register user
                if ($this->userModel->register($data)) {
                    header('location: ' . URLROOT . '/users/login');
                } else {
                    die("Something went wrong");
                }
            } else {
                // load with errors
                $this->view('register', $data);
            }
        } else {
            // init data
            $data = [
                'username' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'username_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            // load view
            $this->view('register', $data);
        }
    }

    public function login()
    {
        // check for POST method
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // process form

            // sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // init data
            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'username_err' => '',
                'password_err' => ''
            ];

            // validate username
            if (empty($data['username'])) {
                $data['username_err'] = 'Please enter username.';
            }
            // validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password.';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters.';
            }
            // ----------------------------------------------------------------------
            // check user jestli existuje
            if (!$this->userModel->findUserByUsername($data['username'])) {

                $data['username_err'] = 'No such username.';
            }
            // ----------------------------------------------------------------------
            // make sure errors are empty
            if (empty($data['username_err']) && empty($data['password_err'])) {
                // validated
                $loggedInUser = $this->userModel->login($data['username'], $data['password']);
                // vrací row nebo false
                if ($loggedInUser) {
                    // jestli logged in -> session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Password does not match.';
                    // load with errors
                    $this->view('login', $data);
                }
            } else {
                // load with errors
                $this->view('login', $data);
            }
        } else {
            // init data
            $data = [
                'username' => '',
                'password' => '',
                'username_err' => '',
                'password_err' => ''
            ];
            // load view
            $this->view('login', $data);
        }
    }

    public function createUserSession($user){
        session_start();
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_username'] = $user->username;
        $_SESSION['user_email'] = $user->email;
        header('location: ' . URLROOT . '/posts/index');
    }

    public function logout() {
       unset($_SESSION['user_id']);
       unset($_SESSION['user_username']);
       unset($_SESSION['user_email']); 
       session_destroy();
       header('location: ' . URLROOT . '/users/login');
    }
}

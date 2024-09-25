<?php

class Users extends Controller{
    public function __construct()
    {
        
    }

    public function register(){
        // check for POST method
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // process form

        } else {
            // INIT DATA
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
}
<?php

class Home extends Controller
{
    public function __construct()
    {
  
    }


    public function index() {
        $data = [
            'title' => 'Welcome to the Messageboard'
        ];
        
        $this->view('home', $data);
    }
}

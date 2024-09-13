<?php

class Controller {
    

    public function view($view, $data = array()){
        if(file_exists("../private/views/" . $view . ".php")){
            require("../private/views/" . $view . ".php");
        } else {
            require("../private/views/404.php");
        }
    }
} 
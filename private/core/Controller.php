<?php

class Controller {
    

    public function view($view, $data = array()){
        extract($data);

        if(file_exists(PRIVATEROOT . "/views/" . $view . ".view.php")){
            require(PRIVATEROOT . "/views/" . $view . ".view.php");
        } else {
            require(PRIVATEROOT . "/views/404.view.php");
        }
    }

    public function model($model){
        require(PRIVATEROOT . '/models/' . $model . '.php');

        return new $model();
    }
} 
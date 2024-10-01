<?php

/* 

** main app file

*/

class App
{
    private $controller = "Home";
    private $method = "index";
    private $params = [];

    public function __construct()
    {
        $url = $this->getUrl();
        // ---------------------------------------------- controller

        if (file_exists(PRIVATEROOT . "/controllers/" . ucfirst($url[0]) . ".php")){
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }
        require PRIVATEROOT . "/controllers/" . $this->controller . ".php";
        $this->controller = new $this->controller();

        //----------------------------------------------- method
        if (isset($url[1]) && method_exists($this->controller, $url[1])){
            $this->method = $url[1];
            unset($url[1]);
        }

        //----------------------------------------------- params
        // reset pole, aby šlo od nuly
        $url = array_values($url);
        $this->params = $url;

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function getUrl()
    {
        if (isset($_GET['url']) && $_GET['url'] !== '') {
            return explode("/", filter_var(trim($_GET['url'], "/"), FILTER_SANITIZE_URL));
        }
        return ['home'];
    }
}




<?php

class App{

    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];


public function __construct()
{
    $url = $this->parseURL();

    if (isset($url[0]) && file_exists('../app/controller/' . $url[0] . '.php')) {
        $this->controller = $url[0];
    } 

    require_once '../app/controller/' . $this->controller . '.php';
    $this->controller = new $this->controller;

    if (isset($url[1]) && method_exists($this->controller, $url[1])) {
        $this->method = $url[1];
        unset($url[1]);
    }

    // Pastikan $url tidak kosong sebelum mengakses elemen
    if (!empty($url)) {
        $this->params = array_values($url);
    } else {
        $this->params = []; // Atur params sebagai array kosong jika $url kosong
    }

    call_user_func_array([$this->controller, $this->method], $this->params);
}


    public function parseURL(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/' , $url);
            return $url;
        }
        return[];
    }
}